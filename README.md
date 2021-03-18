# generate-invoice

Please do the following steps after cloning the repository

1. Create a database with name 'fingent'.

2. Then go to the directory 'generate-invoice/database', then import the database 'fingent.sql' to the created one 'fingent'.

3. The database configuration is written inside the file 'generate-invoice/public_html/config/helper.php'. You can find the database configuration inside the 'cunstructor' of the 'helper' class. 

4. You can acess the web page by calling URL : 'http://localhost/generate-invoice/public_html/index.php'

5. You can create invoice from 'index.php' and clicking on the generate invoice button will store the invoice details to the database and print the invoice.
