<?php

require_once 'dbconfig.php';

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	
	public function register($uname,$email,$upass,$mob,$dob,$sex,$code)
	{ $spec="propic";
		try
		{							
			$password = md5($upass);
			$stmt = $this->conn->prepare("INSERT INTO users(userName,userEmail,userPass,mob,dob,sex,tokenCode) 
			                                             VALUES(:user_name, :user_mail, :user_pass, :user_mob, :user_dob, :user_sex, :active_code)");
			$stmt->bindparam(":user_name",$uname);
			$stmt->bindparam(":user_mail",$email);
			$stmt->bindparam(":user_pass",$password);
			$stmt->bindparam(":user_mob",$mob);
			$stmt->bindparam(":user_dob",$dob);
			$stmt->bindparam(":user_sex",$sex);
			$stmt->bindparam(":active_code",$code);
			$stmt->execute();	
            $stmt = $this->conn->prepare("INSERT INTO images(userEmail,spec) 
			                                             VALUES(:user_mail, :spec)");
	        $stmt->bindparam(":user_mail",$email);
			$stmt->bindparam(":spec",$spec);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function login($email,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM users WHERE userEmail=:email_id");
			$stmt->execute(array(":email_id"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['userStatus']=="Y")
				{
					if($userRow['userPass']==md5($upass))
					{
						$_SESSION['userSession'] = $userRow['userEmail'];
						return true;
					}
					else
					{
						header("Location: index.php?error");
						exit;
					}
				}
				else
				{
					header("Location: index.php?inactive");
					exit;
				}	
			}
			else
			{
				header("Location: index.php?error");
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function resetpassword($email,$upass,$newpass)
	{
		try
		{
			$s= $this->conn->prepare("SELECT * FROM users WHERE userEmail=:email_id");
			$s->execute(array(":email_id"=>$email));
			$us=$s->fetch(PDO::FETCH_ASSOC);
			
				if($us['userPass']==md5($upass))
				{
				    $pass=md5($newpass);
			        $stmt = $this->conn->prepare("UPDATE users SET userPass=:user_pass WHERE userEmail=:email_id");
			        $stmt->bindparam(":email_id",$email);
			        $stmt->bindparam(":user_pass",$pass);				
                    $stmt->execute();	
			       	return true;

				}
					else
					{
					
					echo 'old password incorrect';
				        
					}
			  	
		 }
		
	catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}



	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}
	
	function send_mail($email,$message,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "ssl";                 
		$mail->Host       = "plus.smtp.mail.yahoo.com";      
		$mail->Port       = 465;             
		$mail->AddAddress($email);
		$mail->Username="jishnutheindian@yahoo.com";  
		$mail->Password="TheINDIAN";            
		$mail->SetFrom('jishnutheindian@yahoo.com','miontech');
		$mail->AddReplyTo("jishnutheindian@gmail.com","miontech");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}
	function contactus($email,$message,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "ssl";                 
		$mail->Host       = "localhost";      
		$mail->Port       = 465;             
		$mail->AddAddress($email);
		$mail->Username="user@miontech.in";  
		$mail->Password="jishnu9345(#$%";            
		$mail->SetFrom('$email','miontech');
		$mail->AddReplyTo("support@miontech.in","support");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
		return true;
	}
	
}
