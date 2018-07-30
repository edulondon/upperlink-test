
<?php
require_once ("PHPMailer/class.phpmailer.php");
class DBFunctions{
	
	
	function __construct(){
		
	}
	
	function __destruct(){
		
	}

	public function storeUser($email, $company, $password, $id, $role){
		require_once 'Config.php';
			try {
							$con = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE.';charset=utf8', DB_USER, DB_PASSWORD, array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
							$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
					}catch(Exception $e) {
					//echo $e->getMessage();
					echo "An error has occurred-". $e->getMessage();
					}	
		try{
			$created_at = DATE('Y-m-d h:i:s');
			$stmt = $con->prepare("INSERT INTO users(username,  password, company_id, created_at, id, role)
								VALUES(:username, :password, :company_id, :created_at, :id, :role)");
			
			$stmt->execute(array(':username'=>$email,':password'=>$password,':company_id'=>$company,':created_at'=>$created_at,':id'=>$id,':role'=> $role));
			return true;
		}
		catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
		
		
	}
																						
		public function storeCio($fistName, $lastName, $gender, $designation, $mobile, $email, $company_id, $address, $picture, $nominated){
			//include_once ('DBConnect.php');
			require_once 'Config.php';
			try {
							$con = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE.';charset=utf8', DB_USER, DB_PASSWORD, array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
							$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
					}catch(Exception $e) {
					//echo $e->getMessage();
							return false;
						}	
					
				try{
							$paid = 'No';			
							$created_at = DATE('Y-m-d h:i:s');
							$stmt = $con->prepare("INSERT INTO cios(fistName, lastName, gender, designation, mobile, email, company_id, address, picture, created_at, nominated, paid) 
							VALUES(:fistName, :lastName, :gender, :designation, :mobile, :email, :company_id, :address, :picture, :created_at, :nominated, :paid)");
							
							$stmt->execute(array(':fistName'=>$fistName,':lastName'=>$lastName,':gender'=>$gender,':designation'=>$designation, ':mobile'=>$mobile, ':email'=> $email, ':company_id'=> $company_id, ':address'=> $address, ':picture'=>  $picture, ':created_at'=>  $created_at, ':nominated'=>  $nominated, ':paid'=>$paid));
							$id = $con->lastInsertId();
							return $id;
				} catch(Exception $e) {
						return false;
						//echo $e->getMessage();
				}	
		
	}
public function updateSponsorLogo($sponsors_id, $logo){
			//include_once ('DBConnect.php');
			require_once 'Config.php';
			try {
							$con = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE.';charset=utf8', DB_USER, DB_PASSWORD, array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
							$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
					}catch(Exception $e) {
					//echo $e->getMessage();
							return false;
						}	
					
				try{	
							$stmt = $con->prepare("UPDATE sponsors SET logo = :logo WHERE sponsors_id = :sponsors_id");
							
							$stmt->execute(array(':sponsors_id'=>$sponsors_id, ':logo'=>$logo));
							
							return $stmt;
				} catch(Exception $e) {
						return false;
				}	
		
	}
public function updateSponsorAdvert($sponsors_id, $advert){
			//include_once ('DBConnect.php');
			require_once 'Config.php';
			try {
							$con = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE.';charset=utf8', DB_USER, DB_PASSWORD, array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
							$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
					}catch(Exception $e) {
					//echo $e->getMessage();
							return false;
						}	
					
				try{	
							$stmt = $con->prepare("UPDATE sponsors SET advert = :advert WHERE sponsors_id = :sponsors_id");
							
							$stmt->execute(array(':sponsors_id'=>$sponsors_id, ':advert'=>$advert));
							
							return $stmt;
				} catch(Exception $e) {
						return false;
				}	
		
	}
	public function updateCio($id, $fistName, $lastName, $gender, $designation, $mobile, $company_id, $address,  $updated_at, $nominated){
			//include_once ('DBConnect.php');
			require_once 'Config.php';
			try {
							$con = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE.';charset=utf8', DB_USER, DB_PASSWORD, array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
							$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
					}catch(Exception $e) {
					//echo $e->getMessage();
							return false;
						}	
					
				try{	
							$stmt = $con->prepare("UPDATE cios SET fistName = :fistName, 
							lastName = :lastName, gender = :gender, designation = :designation, 
							mobile = :mobile, company_id = :company_id, 
							address = :address, updated_at = :updated_at, nominated = :nominated WHERE id = :id");
							
							$stmt->execute(array(':id'=>$id, ':fistName'=>$fistName,':lastName'=>$lastName,':gender'=>$gender,':designation'=>$designation, ':mobile'=>$mobile, ':company_id'=> $company_id, ':address'=> $address,':updated_at'=>  $updated_at, ':nominated'=>  $nominated));
							
							return $stmt;
				} catch(Exception $e) {
						return false;
				}	
		
	}
		
	public function getCio($id){
		include_once ('DBConnect.php');
		
		$stmt = $con->prepare("SELECT * FROM cios WHERE id = ? LIMIT 1");
		$stmt->bindParam(1,$id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
		}

	public function getUserByUsernameAndPassword($username, $password){
		include_once ('DBConnect.php');
		
		$stmt = $con->prepare("SELECT * FROM users WHERE username = ? AND password =? LIMIT 1");
		$stmt->bindParam(1,$username);
		$stmt->bindParam(2,$password);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

		}	

	public function getNominatedCios(){
		include_once ('DBConnect.php');
		$nominated = 1;
			$stmt = $con->prepare("SELECT * FROM cios WHERE nominated = ?");
			$stmt->bindParam(1,$nominated);
			$stmt->execute();
			if($stmt){
				$result = $stmt->fetchAll();
				//$result = $stmt->fetch(PDO::FETCH_BOTH);
				return $result; 
			}
			else{
				return false;
			}
		}
	public function getPaidCios(){
		include_once ('DBConnect.php');
		$paid = 1;
			$stmt = $con->prepare("SELECT * FROM cios WHERE paid = ?");
			$stmt->bindParam(1,$paid);
			$stmt->execute();
			if($stmt){
				$result = $stmt->fetchAll();
				//$result = $stmt->fetch(PDO::FETCH_BOTH);
				return $result; 
			}
			else{
				return false;
			}
		}
	public function getCios(){
		include_once ('DBConnect.php');
		
			$stmt = $con->prepare("SELECT * FROM cios");
			$stmt->execute();
			if($stmt){
				$result = $stmt->fetchAll();
				//$result = $stmt->fetch(PDO::FETCH_BOTH);
				return $result;
			}
			else{
				return false;
			} 
		}

	public function getSponsorByid($id){
		require_once 'Config.php';
			try {
							$con = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE.';charset=utf8', DB_USER, DB_PASSWORD, array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
							$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
					}catch(Exception $e) {
					//echo $e->getMessage();
							return false;
						}
		$stmt = $con->prepare("SELECT * FROM sponsors s INNER JOIN sponsors_contact c WHERE s.sponsors_id = c.sponsors_id AND s.sponsors_id = ? LIMIT 1");
		$stmt->bindParam(1,$id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		//$result = $stmt->fetchAll();
		return $result;
		}

			public function getSponsors(){
				include_once ('DBConnect.php');
			$stmt = $con->prepare("SELECT * FROM sponsors s INNER JOIN sponsors_contact c WHERE s.sponsors_id = c.sponsors_id");
			$stmt->execute();
			if($stmt){
				$result = $stmt->fetchAll();
				//$result = $stmt->fetch(PDO::FETCH_BOTH);
				return $result;
			}
			else{
				return false;
			} 
		}
	public function isUserExisted($username){
		include_once ('DBConnect.php');
		$stmt = $con -> prepare("SELECT username from users WHERE username = ? ");
		$stmt -> bindParam(1, $username);
		$stmt->execute();
		$no_of_rows = $stmt->rowCount();
		if($no_of_rows > 0){
			return true;
		}else{
			return false;
		}
	}
		
		public function storeCioSponsor($company, $mobile, $email, $category, $comment, $logo, $advert, $address, $topic){
			//include_once ('DBConnect.php');
			require_once 'Config.php';
			try {
							$con = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE.';charset=utf8', DB_USER, DB_PASSWORD, array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
							$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
					}catch(Exception $e) {
					//echo $e->getMessage();
							return false;
						}	
					
				try{
								$created_at = DATE('Y-m-d');

							$stmt = $con->prepare("INSERT INTO sponsors(email, company, address, category, comment, logo, advert, topic, mobile, created_at) 
							VALUES(:email, :company, :address, :category, :comment, :logo, :advert, :topic, :mobile, :created_at)");
							
							$stmt->execute(array(':email'=>$email,':company'=>$company,':address'=>$address,':category'=>$category, ':comment'=>$comment, ':logo'=> $logo, ':advert'=> $advert, ':topic'=> $topic, ':mobile'=>$mobile, ':created_at'=>  $created_at));
							$id = $con->lastInsertId();
							return $id;
				} catch(Exception $e) {
						return false;
				}	
		
	}

	public function storeSponsorContact($id, $cp_mobile, $firstName, $lastName, $gender, $cp_email, $designation){
			//include_once ('DBConnect.php');
			require_once 'Config.php';
			try {
							$con = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE.';charset=utf8', DB_USER, DB_PASSWORD, array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
							$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
					}catch(Exception $e) {
					//echo $e->getMessage();
							return false;
						}	
					
				try{
								
							$stmt = $con->prepare("INSERT INTO sponsors_contact( firstName, lastName, cp_mobile, designation, email, gender, sponsors_id) 
							VALUES(:firstName, :lastName, :cp_mobile, :designation, :email, :gender, :sponsors_id)");
							
							$stmt->execute(array(':firstName'=>$firstName,':lastName'=>$lastName,':cp_mobile'=>$cp_mobile,':designation'=>$designation, ':email'=>$cp_email, ':gender'=> $gender, ':sponsors_id'=> $id));
							
							return true;
				} catch(Exception $e) {
						return false;
				}	
		
	}
	
	public function uploadLogo($logo){
	  if(isset($logo)){
		$name = $logo['name'];
		$result = move_uploaded_file($logo['tmp_name'], "../image/{logo['name']}");
			if(isset($result)){
			return $name;
			}
	  }
		
    }

	
	public function uploadDSign($dSign){ 
	  if(isset($dSign)){
		$name = $dSign['name'];
		$result = move_uploaded_file($dSign['tmp_name'], "../image/{dSign['name']}");
			if(isset($result)){
			return $name;
			}
	  }
		
    }
	
	public function uploadSRSign($srSign){ 
	  if(isset($srSign)){
		$name = $srSign['name'];
		$result = move_uploaded_file($srSign['tmp_name'], "../image/{$srSign['name']}");
			if(isset($result)){
			return $name;
			}
	  }
		
    }
public function sendMail($email){
require_once ("PHPMailer/class.phpmailer.php");
$sender = "NIA-ITC";
											$mail = new PHPMailer();
											//$mail->IsSMTP();  
											$mail->SMTPDebug = 1;                                    // Set the SMTP port
											$mail->SMTPAuth = true; 
											$mail->SMTPSecure = 'SSL';                            // Enable encryption, 'ssl' also accepted
											$mail->Host = 'smtp.gmail.com';   
											$mail->Port = 465; //587;                              // Enable SMTP authentication
											$mail->IsHTML(true);
											$mail->Username = 'niaitcwelfare17@gmail.com'; //welfare@nia-itc.org';                // SMTP username
											$mail->Password = 'welfare2017';                  // SMTP password
											$mail->SetFrom("niaitcwelfare17@gmail.com");
											$mail->FromName = 'NIA ITC Welfare';
											
											$mail->AddAddress($email);               // receiver's email.

											$mail->Subject = 'Happy Birthday';
											
											
									$message = ' Hello ITC	';	
									$mail->Body  = $message;
									$mail->Send();								






//require 'phpmailer/PHPMailerAutoload.php';
//include 'phpmailer/class.phpmailer.php';
//echo !extension_loaded('openssl')?"Not Available":"Available <br/>";
/*
$mail = new PHPMailer;



$mail->isSMTP();   
$mail->SMTPDebug = 2;                               // Enable verbose debug output
$mail->Mailer = 'smtp';                                   // Set mailer to use SMTP
$mail->Host = 'ssl://smtp.gmail.com';       //  ssl://smtp.gmail.com          // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'ciocommittee@gmail.com';                      // SMTP username
$mail->Password = 'cio@2017';                           // SMTP password
$mail->SMTPSecure = 'ssl';  //TLS                      // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;          //587                          // TCP port to connect to


//echo $email= $_POST['n2']."@".$_POST['n3'];
$mail->setFrom('ciocommittee@gmail.com', 'user name');
//$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
$mail->addAddress($email);               // Name is optional
//$mail->addReplyTo('$email','roshan');
//$mail->addCC('passmethecode@gmail.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Booking request to PERIYAR NEST';
$mail->Body    = 
   
    'Thank you for registering';
//file_get_contents('template-guest.php');
$mail->AltBody = 'Hello';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
else {
//header('location: thankyou.php');
 echo 'Message sent successfully';
}  */

}
}
$test = new DBFunctions(); 
//echo json_encode($test -> getUserByUsernameAndPassword('pep4love', 'joe'));
//echo json_encode($test -> getCio(2));
// echo json_encode($test -> updateCio(1, 'joe', 'monye', 'male', 'IT Officer', '08020375032', 'Nigeria Ins Ass.', '42',  '2017-06-07 02:27:32', 0));
 //echo json_encode($test -> storeCioSponsor('monyejoe@gmail.com','EXO Mobile',  'address', 'gold',  'technology', 'logo', 'advert','topic', '07031105312', '2017-05-6' ));
//echo json_encode($test ->storeSponsorContact(3, "cp_mobile", "firstName", "lastName", "gender", "cp_email", "designation"));
//echo json_encode($test->getSponsor(2));
//echo json_encode($test->storeUser("fistName", "lastName", "gender", "designation", "mobile"));
echo json_encode($test->sendMail('monyejoe@gmail.com'));

?>