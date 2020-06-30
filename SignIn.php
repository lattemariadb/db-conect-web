<?php 
    error_reporting(E_ALL); 
    ini_set('display_errors',1); 
    include('dbcon.php');

    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

    if( (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) || $android ) {
        $deviceId = $_POST['deviceId'];
        $name = $_POST['name'];
        $birthday = $_POST['birthday'];
        $sex = $_POST['sex'];
        $email = $_POST['email'];
        $homePhone = $_POST['homePhone'];
        $phone = $_POST['phone'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        $zipCode = $_POST['zipCode'];
        $textReceivingAgreement = $_POST['textReceivingAgreement'];
        $emailReceivingAgreement = $_POST['emailReceivingAgreement'];

        if(empty($deviceId)){
            $errMessage = "디바이스 아이디를 입력하세요.";
        } else if(empty($name)){
            $errMessage = "이름을 입력하세요.";
        } else if(empty($birthday)) {
            $errMessage = "생일을 입력하세요.";
        } else if(empty($sex)) {
            $errMessage = "성별을 입력하세요.";
        } else if(empty($email)) {
            $errMessage = "이메일을 입력하세요.";
        } else if(empty($homePhone)) {
            $errMessage = "집 전화번호를 입력하세요.";
        } else if(empty($phone)) {
            $errMessage = "전화번호를 입력하세요.";
        } else if(empty($address1)) {
            $errMessage = "지역1을 입력하세요.";
        } else if(empty($address2)) {
            $errMessage = "지역2을 입력하세요.";
        } else if(empty($zipCode)) {
            $errMessage = "우편번호를 입력하세요.";
        } else if(empty($textReceivingAgreement)) {
            $errMessage = "문자수신동의 체크하세요.";
        } else {
            $errMessage = "이메일수신동의 체크하세요.";
        }

        if(!isset($errMessage)) 
        {
            try{
                $stmt = $con->prepare('INSERT INTO userinfo(deviceId, name, birthday, sex, email, homePhone, phone, address1, address2, zipCode, textReceivingAgreement, emailReceivingAgreement) VALUES(:deviceId, :name, :birthday, :sex, :email, :homePhone, :phone, :address1, :address2, :zipCode, :textReceivingAgreement, :emailReceivingAgreement');
                $stmt->bindParam(':deviceId', $deviceId);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':birthday', $birthday);
                $stmt->bindParam(':sex', $sex);
                $stmt->bindParam(':email', $namemaile);
                $stmt->bindParam(':homePhone', $homePhone);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':address1', $address1);
                $stmt->bindParam(':address2', $address2);
                $stmt->bindParam(':zipCode', $zipCode);
                $stmt->bindParam(':textReceivingAgreement', $textReceivingAgreement);
                $stmt->bindParam(':emailReceivingAgreement', $emailReceivingAgreement);

                if($stmt->execute())
                {
                    $successMSG = "새로운 사용자를 추가했습니다.";
                } else {
                    $errMessage = "사용자 추가 에러";
                }

            } catch(PDOException $e) {
                die("Database error: " . $e->getMessage()); 
            }
        }

    }

?>


<?php 
    if (isset($errMessage)) echo $errMessage;
    if (isset($successMSG)) echo $successMSG;

	$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
   
    if( !$android )
    {
?>
    <html>
       <body>
            <form action="<?php $_PHP_SELF ?>" method="POST">
                Name: <input type = "text" name = "name" />
                Country: <input type = "text" name = "country" />
                <input type = "submit" name = "submit" />
            </form>
       </body>
    </html>

<?php 
    }
?>