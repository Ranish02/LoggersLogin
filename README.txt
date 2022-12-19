
# Loggers Login

Loggers Login is a project that implies some of the vital cyber security compononent.
It provides an user interface where new user can create an account and relax. Because their data is completely secure using diffrent forms of security like: cryptography, two-factor authentication, etc.
The registered user can login using their credentials and without any fear of account compromisation. 

## Authors

- [@Ranish02](https://github.com/Ranish02)


## Environment Variables

To run this project, you will need to make changes to the following environment variables in the project file.

Setup mail server to run this project properly

1) Open XAMPP Installation Directory.
2) Go to C:\xampp\php and open the php.ini file.
3) Find [mail function] by pressing ctrl + f.
4) Find and Pass the following values along with your own google account credentials:

SMTP=smtp.gmail.com
smtp_port=587
sendmail_from = YourGmailId@gmail.com
sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"

5) Now, go to C:\xampp\sendmail and open sendmail.ini file.
6) Find [sendmail] by pressing ctrl + f.
7) Search and pass the following values along with your own google account credentials:

smtp_server=smtp.gmail.com
smtp_port=587
error_logfile=error.log
debug_logfile=debug.log
auth_username=YourGmailId@gmail.com
auth_password=Your-Gmail-Password
force_sender=YourGmailId@gmail.com(optional)

## FAQ

#### Can a user create multiple account using one e-mail?

No, we have limited one account per e-mail.

#### How can you ensure our account security?

We do have alot of security measures that ensures data and account security. Some of major ones are your information are encrypted and two-factor authentication secures your account from any unathorised access.

#### How to change no of attempts value before locking out an account?

You can change the no of attempts before locking out an account by heading over to the LoggersLogin/loginmytry.php file on line 101 : change the value from 5 to your requirements.



## Support

For support, email loggerslogin134@gmail.com .

