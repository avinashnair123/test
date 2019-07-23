        </div><!-- /.container --> 
    </body>
    <script language='javascript' type='text/javascript'>

        function check(input) {
            if (input.value != document.getElementById('password').value) {
                input.setCustomValidity('Password Must be Matching.');
                $('#password-confirmation-message').show();
            } else {
            input.setCustomValidity('');
            $('#password-confirmation-message').hide();
            }
        }
        
    </script>
</html>