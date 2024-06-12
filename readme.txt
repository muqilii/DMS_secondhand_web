
Please create database " second_hand_store" first !

And change the maximum limitation of the choosen file from 2048kb to 10MB ! 

Steps are as followed:

Open the php.ini in the folder of xampp, find 'upload_max_filesize', 'memory_limit', 'post_max_size'
change upload_max_filesize = 10M, memory_limit = 512M, post_max_size = 8M

Remember to restart XAMPP after changing these attributes !

The default path of product images is 'C:\\xampp\\htdocs\\group12\\image\\' (store in test.php file)

3 type accounts 
buyer: John Doe           password: 123
seller: A    	     password: 123
admin: Anna Johnson   password: 123 