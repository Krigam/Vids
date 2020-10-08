<?php
class VideoProcessor{

    private $con;
    private $sizeLimit=1000000000;
    private $allowedTypes=array("mp4","flv","webm","mkv","vob","ogv","avi","wmv","mov","mpeg","mpg");
    // Path variable for ffmpeg (video converter)
    private $ffmpegPath;
    // Path variable for ffprobe (getting video duration)
    private $ffprobePath;

    public function __construct($con){
        $this->con=$con;

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // for Windows
            $this->ffmpegPath = realpath("FFmpeg/bin/ffmpeg.exe");
            $this->ffprobePath = realpath("FFmpeg/bin/ffprobe.exe");
        } else {
            // For Linux
            $this->ffmpegPath = "ffmpeg";
            $this->ffprobePath = "ffprobe";
        }
    }

    public function upload($videoUploadData){
        // Direction folder where videos are safed
        $targetDir="uploads/videos/";
        // get videoData from VideoUploadData
        $videoData=$videoUploadData->videoDataArray;

        // create temporary File path with unique id and name
        $tempFilePath= $targetDir . uniqid() . basename($videoData["name"]);#
        $tempFilePath=str_replace(" ", "_",$tempFilePath);

        $isValidData=$this->processdata($videoData,$tempFilePath);

        // Was there an error? -> return false
        if(!$isValidData){
            return false;
        }

        // no error -> continue
        // move Video to temporary folder
        if(move_uploaded_file($videoData["tmp_name"],$tempFilePath)){
            // construct final path for .mp4 video file
            $finalFilePath=$targetDir . uniqid() . ".mp4";

            if(!$this->insertVideoData($videoUploadData, $finalFilePath)){
                echo "<img class='error' src='assets/images/icons/error.png' alt='error'>";
                echo "</br>";
                echo "Insert query failed";
                return false;
            }

            // check if video gets converted
            if(!$this->convertVideoToMp4($tempFilePath, $finalFilePath)){
                echo "<img class='error' src='assets/images/icons/error.png' alt='error'>";
                echo "</br>";
                echo "Upload failed. Could not convert Video";
                return false;
            }

            // check if temp video gets deleted
            if(!$this->deleteFile($tempFilePath)){
                echo "<img class='error' src='assets/images/icons/error.png' alt='error'>";
                echo "</br>";
                echo "Upload failed. Could not delete File";
                return false;
            }

            // generate random Thumbnail
            if(!$this->generateThumbnail($finalFilePath)){
                echo "<img class='error' src='assets/images/icons/error.png' alt='error'>";
                echo "</br>";
                echo "Upload failed. Could not generate Thumbnails";
                return false;
            }

            return true;
        }
    }

    private function processData($videoData,$filePath){
        // get video extension
        $videoType=pathInfo($filePath, PATHINFO_EXTENSION);

        // check video size
        if(!$this->isValidSize($videoData)){
            echo "<img class='error' src='assets/images/icons/error.png' alt='error'>";
            echo "</br>";
            echo "File too large. Max. Video size is ".$this->sizeLimit/1000000;
            echo " GB";
            return false;
        }
        else if(!$this->isValidType($videoType)){
            echo "<img class='error' src='assets/images/icons/error.png' alt='error'>";
            echo "</br>";
            echo "Invalid File Type. Supported File types are: ";
            echo "mp4, flv,webm ,mkv ,vob ,ogv ,avi ,wmv ,mov ,mpeg ,mpg ";
            return false;
        }
        else if($this->hasError($videoData)){
            echo "<img class='error' src='assets/images/icons/error.png' alt='error'>";
            echo "</br>";
            echo "Error code: ".$videoData["error"];
            return false;
        }

        return true;
    }

    private function isValidSize($data){
        return $data["size"]<=$this->sizeLimit;
    }

    private function isValidType($type){
        $lowercased=strtolower($type);
        return in_array($lowercased, $this->allowedTypes);
    }

    private function hasError($data){
        return $data["error"]!=0;
    }

    private function insertVideoData($uploadData, $filePath){
        // SQL Insert into table videos
        $query=$this->con->prepare(
            "INSERT INTO videos(title,uploadedBy,description,privacy,category,filePath)
             VALUES(:title, :uploadedBy, :description, :privacy, :category, :filePath)");

        // set VALUES(:variable) from uploadData
        $query->bindParam(":title", $uploadData->title);
        $query->bindParam(":uploadedBy", $uploadData->uploadedBy);
        $query->bindParam(":description", $uploadData->description);
        $query->bindParam(":privacy", $uploadData->privacy);
        $query->bindParam(":category", $uploadData->category);
        $query->bindParam(":filePath", $filePath);

        return $query->execute();
    }

    public function convertVideoToMp4($tempFilePath, $finalFilePath){
        // cmd command to execute ffmpeg to convert video file
        $cmd= "$this->ffmpegPath -i $tempFilePath $finalFilePath 2>&1";

        // variable to store error messages/ Logs
        $outputLog= array();
        // execute cmd command 
        // returnCode 0 -> no error
        exec($cmd, $outputLog, $returnCode);

        if($returnCode != 0){
            // Command failed
            foreach($outputLog as $line){
                echo $line . "<br>";
            }
            return false;
        }

        return true;
    }

    // delete temp video file
    private function deleteFile($filePath){
        if(!unlink($filePath)){
            echo "<img class='error' src='assets/images/icons/error.png' alt='error'>";
            echo "</br>";
            echo "Could not delete file\n";
            return false;
        }

        return true;
    }

    // Generate Random Thumbnail
    public function generateThumbnail($filePath){
        $thumbnailSize= "210x118";
        $pathToThumbnail= "uploads/thumbnails";
        $duration = $this->getVideoDuration($filePath);

        // get last added Id to table
        $videoId=$this->con->lastInsertId();
        // calculate and update Duration in table
        $this->updateDuration($duration, $videoId);

        // generate random img name
        $imageName= uniqid() . ".jpg";
        // calculate seconds of duration
        $secs= floor($duration % 60);
        // generate random time for Thumbnail Timing
        $thumbnailTime= rand(1,$secs);
        // variable for Thumbnail Path
        $fullThumbnailPath="$pathToThumbnail/$videoId-$imageName";

        // cmd command to execute ffmpeg to get thumbnail image
        $cmd = "$this->ffmpegPath -i $filePath -ss $thumbnailTime -s $thumbnailSize -vframes 1 $fullThumbnailPath 2>&1";

        // variable to store error messages/ Logs
        $outputLog= array();
        // execute cmd command 
        // returnCode 0 -> no error
        exec($cmd, $outputLog, $returnCode);
        
            if($returnCode != 0){
                // Command failed
                foreach($outputLog as $line){
                    echo $line . "<br>";
                }
                return false;
            }

            $query= $this->con->prepare("INSERT INTO thumbnails(videoid, filePath)
                                         VALUES(:videoid, :filePath)");
            $query->bindParam(":videoid", $videoId);
            $query->bindParam(":filePath", $fullThumbnailPath);

            $success= $query->execute();

            if(!$success){
                echo "<img class='error' src='assets/images/icons/error.png' alt='error'>";
                echo "</br>";
                echo "Query failed to update thumbnail\n";
                return false;
            }
            return true;
    }

    private function getVideoDuration($filePath){
        return (int)shell_exec("$this->ffprobePath -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 $filePath");
    }

    private function updateDuration($duration, $videoId){
        // calculate Video duration
        $hours= floor($duration/ 3600);
        $mins= floor(($duration-($hours*3600))/60);
        $secs= floor($duration % 60);

        // if hours < 1 -> "", else ":"
        $hours= ($hours<1) ? "" : $hours . ":";
        $mins= ($mins<10) ? "0" . $mins . ":" : $mins . ":";
        $secs= ($secs<10) ? "0" . $secs : $secs;

        $duration = $hours.$mins.$secs;

        $query = $this->con->prepare("UPDATE videos SET duration=:duration WHERE id=:videoId");

        $query->bindParam(":duration", $duration);
        $query->bindParam(":videoId", $videoId);

        $query->execute();
    }
}
?>