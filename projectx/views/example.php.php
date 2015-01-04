<h1>Hello World!</h1>

<?php foreach ($result as $row) 
{
    echo $row['id'].' '.$row['username'].'<br/>';    
} ?>

<?php echo $form->openForm('http://localhost/home/', 'post'); ?>
<?php echo $form->setField('text', 'name', 'Name'); ?> <br />
<?php echo $form->setField('text', 'email', 'Email'); ?><br />
<?php echo $form->setTextarea('test', 'tekst', 'Uw bericht'); ?><br />
<?php echo $form->setSubmit('form_submit', 'Submit'); ?> <br />
<?php echo $form->closeForm(); ?>


