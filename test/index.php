<?php

require_once('validation.php');

$validation = new Validation();

?>

<!DOCTYPE html>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<head>
    <link rel="stylesheet" href="main.css" />
</head>

<body>

<div class="container">

<h1>Form Validation Class</h1>

<?php        
    //Set rules for the 'name' field
    $field = 'name';
    $validationRules = array(      
                           'required' => TRUE,
                           'minLength' => 2,
                           'maxLength' => 15,
                           'alphaNumeric' => TRUE
                       );
    $validation->setValidation($field, $validationRules);

    //Set rules for the 'email' field
    $field = 'email';
    $validationRules = array(
                           'required' => true,
                           'minLength' => 2,
                           'maxLength' => 40,
                           'validEmail' => true
                       );
    $validation->setValidation($field, $validationRules);
    
    //Set rules for the 'website' field
    $field = 'website';
    $validationRules = array(
                           'minLength' => 2,
                           'maxLength' => 40,
                           'validURL' => true
                       );
    $validation->setValidation($field, $validationRules);
    
    //Set rules for the 'password' field
    $field = 'password';
    $validationRules = array(
                           'required' => true,
                           'minLength' => 2,
                           'maxLength' => 10,
                           'aplhaNumeric' => TRUE
                       );                       
    $validation->setValidation($field, $validationRules);
    
    //Set rules for the 'passwordConfirm' field
    $field = 'passwordConfirm';
    $validationRules = array(        
                           'minLength' => 2,
                           'maxLength' => 10,
                           'aplhaNumeric' => TRUE,
                           'match' => 'password'
                       );
    $validation->setValidation($field, $validationRules);
    
    //Set rules for the 'passwordConfirm' field
    $field = 'lower';
    $validationRules = array(        
                           'numeric' => TRUE,
                           'lessThan' => 10
                       );
    $validation->setValidation($field, $validationRules);
    
    //Set rules for the 'passwordConfirm' field
    $field = 'higher';
    $validationRules = array(        
                           'numeric' => TRUE,
                           'greaterThan' => 10
                       );
    $validation->setValidation($field, $validationRules);
    
    //Set rules for the 'team' select dropdown
    $field = 'team';
    $validationRules = array(            
                           'required' => TRUE
                       );
    $validation->setValidation($field, $validationRules);
    
    //Set rules for the 'language' radio button(s)
    $field = 'language';
    $validationRules = array(            
                           'required' => TRUE
                       );
    $validation->setValidation($field, $validationRules);
    
    //Set rules for the 'terms' checkbox
    $field = 'terms';
    $validationRules = array(            
                           'required' => TRUE
                       );
    $validation->setValidation($field, $validationRules);

    
    //Validate the fields (has to be called after the validationRules have been set and before the fields)
    if(isset($_POST['form_submit']))
    {
        if($validation->validateFields($_POST))
        {
            //validateFields() returns TRUE, Process the data in a database
		echo 'ok';
        }
    }

    
    //Open the form
    echo $validation->openForm('index.php', 'POST');
    
    //Set a text field
    echo $validation->setField('text', 'name', 'Name');
    
    //Set a text field
    echo $validation->setField('text', 'email', 'Email');
    
    //Set a text field
    echo $validation->setField('text', 'website', 'Website', 'example: www.my-website.com');
    
    //Set a password field
    echo $validation->setField('password', 'password', 'Password');
    
    //Set a password field
    echo $validation->setField('password', 'passwordConfirm', 'Confirm Password', 'Has to match Password');
    
    //Set a lower field
    echo $validation->setField('text', 'lower', 'Type a number lower than 10');
    
    //Set a higher field
    echo $validation->setField('text', 'higher', 'Type a number higher than 10');
        
    //Set a select dropdown menu
    $selectOptions = array(
                         'Real Madrid' => 'real_madrid',
                         'Barcelona' => 'barcelona',
                         'Chelsea' => 'chelsea',
                         'Bayern Munchen' => 'bayern_munchen'
                     );
    echo $validation->setSelect('team', 'Champions League winner', $selectOptions, 'Halla Madrid');
    
    //Set radio buttons
    $radioOptions = array(
                        'English' => 'english',
                        'Dutch' => 'dutch'
                    );
    echo $validation->setRadio('language', 'Language', $radioOptions);
    
    //Set a checkbox
    echo $validation->setCheckbox('terms', 'I accept the terms and conditions');    
    
    //Set the submit button
    echo $validation->setSubmit('form_submit', 'Submit');
    
    //Close the form
    echo $validation->closeForm();
?>

</div><!-- End container -->

</body>

<html>
