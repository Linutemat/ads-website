<form method="post" action="/registration">
    Register
    <div id="individual">
        Fizinis asmuo
    </div>
    <div id="company">
        Juridinis asmuo
    </div>
    <div>
        <input type="email" name="email" placeholder="Email"/>
    </div>
    <div>
        <input id="company-code-field" type="text" name="company_code" placeholder="Company code" hidden/>
    </div>
    <div>
        <input type="password" name="password" placeholder="Password"/>
    </div>
    <div>
        <input type="password" name="password_repeat" placeholder="Repeat password"/>
    </div>
    <div>
        <input type="tel" name="phone_number" placeholder="Phone Number"/>
    </div>
    <input type="submit">
    <script>
        document.getElementById('company').addEventListener('click', (event) => {
            document.getElementById('company-code-field').removeAttribute('hidden');
        });
    </script>
</form>