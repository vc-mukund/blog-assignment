$(document).ready(function(){

    $('#addUser').submit(function(){
       
        let fname = $('#fname').val();
        let lname = $('#lname').val();
        let email = $('#email').val();
        let dob = $('#dob').val();
        let password = $('#password').val();
        let role = $('#role').val();

        $('.error').remove();

        if (fname.length < 1) {
            $('#fname').after('<span class="error text-danger">Plese enter your first name.<span>');
            return false;
        }
        if (lname.length < 1) {
            $('#lname').after('<span class="error text-danger">Plese enter your last name.<span>');
            return false;
        }
        if(email.length < 1){
            $('#email').after('<span class="error text-danger">Plese enter your email.<span>');
            return false;
        }
        if(dob.length < 1){
            $('#dob').after('<span class="error text-danger">Plese enter date of birth.<span>');
            return false;
        }
        if (password.length < 8) {
            $('#password').after('<span class="error text-danger">Plese enter password atleast 8 characters.<span>');
            return false;
        }
        if (role == null) {
            $('#role').after('<span class="error text-danger">Plese select any one role.<span>');
            return false;
        }
        
    });
});