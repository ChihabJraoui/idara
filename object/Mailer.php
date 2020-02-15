<?php
/**
 * Created by IntelliJ IDEA.
 * User: Chihab
 * Date: 03/02/2016
 * Time: 13:43
 */
require_once 'res/smtp/class.phpmailer.php';

use Objects\Member;

class Mailer
{
	private $mail;      // PHPMailer Object
	private $member;    // Member Object
	private $activationCode;

	public function __construct()
	{
		$this->mail = new PHPMailer();

		$this->mail->IsHTML(true);
		$this->mail->SMTPAuth = true;                  	// enable SMTP authentication
		$this->mail->SMTPSecure = "tls";
		$this->mail->Host = "mx1.hostinger.ae"; 		// Amazon SES server, note "tls://" protocol
		$this->mail->Port = "110";                    		// set the SMTP port
		$this->mail->Username = "contact@alafa9.com";	// SMTP  username
		$this->mail->Password = "Wade4Ever";  				// SMTP password

		$this->mail->SetFrom("contact@alafa9.com", "Alafa9 Forums");
		$this->mail->AddReplyTo("contact@alafa9.com", "Alafa9 Forums");

		$this->mail->CharSet = "UTF-8";
	}


	/*
	 * Setters
	 */
	public function setMember(Member $member)
	{
		$this->member = $member;
	}
	public function setActivationCode($code)
	{
		$this->activationCode = $code;
	}


	/*
	 * Functions
	 */

	public function emailConfirm()
	{
		$this->mail->AddAddress($this->member->getEmail(), $this->member->getFName() . ' ' . $this->member->getLName());
		$this->mail->Subject = "مرحبا بكم في منتديات الآفاق";
		$this->mail->Body = '
		<html>
			<body style="font-family: tahoma, sans-serif; font-size: 14px; direction: rtl;">

				<section style="background: #eee; max-width: 700px; margin: auto;">
					<div style="width: 80%; margin: auto; background-color: #fff;">

						<div style="padding: 30px; background: #333 url('. Config::ImagesFolder .'/covers/002.jpg) no-repeat
						center; background-size: cover; vertical-align: middle;">
							<h3 style="color: #eee; font-family: arial, sans-serif; font-size: 24px;">
								مرحبا بكم في منتديات الآفاق
							</h3>
						</div>

						<div style="padding: 20px;">
							<h3 style="color: #009688; font-family: arial, sans-serif; font-size: 18px;">
								مرحبا، '. $this->member->getName() .'
							</h3>
							<p>
								شكرا جزيلا لتسجيلكم بمنتدياتنا، يمكنكم الدخول باسم المستخدم وكلمة المرور التي اخترتموها أثناء عملية التسجيل و البدأ بالمشاركة في المنتديات
								لكن أولا يتوجب عليكم تفعيل حسابكم، وذلك بالنقر على الزر أسفله :
							</p>
							<div style="text-align: center;">
								<a href="http://www.alafa9.com/demo/v1/index/verify/?code='. $this->activationCode .'"
									style="display: inline-block; color: #eee; background-color: #009688; padding: 10px 15px; font-size: 14px; font-weight: bold;
									border-bottom: 3px solid #00695C; text-decoration: none;">
									تفعيل الحساب
								</a>
							</div>
							<p>
								إذا كان لديكم أي استفسار أو اقتراح لا تترددوا في مراسلتنا.
								<br />
								بالتوفيق.
							</p>
							<p style="text-align: left;">
								إدارة منتديات الآفاق

							</p>
						</div>

						<div style="text-align: center; padding: 20px; border-top: 1px solid #ddd;">
							<a href="#">
								<img src="'. Config::ImagesFolder .'sm/black_circle_facebook.png" height="30" width="30" />
							</a>

							<a href="#">
								<img src="'. Config::ImagesFolder .'sm/black_circle_twitter.png" height="30" width="30" />
							</a>

							<a href="#">
								<img src="'. Config::ImagesFolder .'sm/black_circle_googleplus.png" height="30" width="30" />
							</a>

							<p style="font-size: 11px; color: #666;">
								contact@alafa9.com
								<br />
								منتديات الآفاق © 2016
							</p>
						</div>
					</div>
				</section>

			</body>
		</html>';

		return $this->mail->Send();
	}
}