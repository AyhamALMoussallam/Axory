<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign In</title>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<style>
body { font-family: Arial, sans-serif; background: #f0f2f5; display:flex; justify-content:center; align-items:center; height:100vh; margin:0; }
.container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1); width: 350px; }
h2 { text-align:center; margin-bottom: 20px; }
input { width: 100%; padding: 10px; margin: 8px 0; border-radius: 5px; border: 1px solid #ccc; box-sizing: border-box; }
button { width: 100%; padding: 10px; margin-top: 10px; border:none; border-radius:5px; background:#4CAF50; color:white; cursor:pointer; }
button:hover { background:#45a049; }
.google-btn { background:#db4437; margin-top: 15px; }
.google-btn:hover { background:#c1351d; }
.message { margin-top: 10px; color: red; text-align:center; }
.toggle { text-align:center; margin-top:15px; }
.toggle a { color: #007bff; text-decoration: none; }
.toggle a:hover { text-decoration: underline; }
</style>
</head>
<body>

<div class="container">
    <h2>Sign In</h2>

    <form id="signin-form" onsubmit="event.preventDefault(); login();">
        <input type="email" id="login-email" placeholder="Email" required>
        <input type="password" id="login-password" placeholder="Password" required>
        <button type="submit">Sign In</button>
    </form>

    <button class="google-btn" onclick="googleLogin()">Sign In with Google</button>

    <div class="toggle">
        Don't have an account? <a href="{{ route('register') }}">Sign Up</a>
    </div>

    <div class="message" id="message"></div>
</div>

<script>
const apiBase = '/api';

function login() {
    const email = document.getElementById('login-email').value;
    const password = document.getElementById('login-password').value;

    axios.post(`${apiBase}/login`, { email, password })
        .then(res => {
            localStorage.setItem('auth_token', res.data.token);
            window.location.href = '/dashboard';
        })
        .catch(err => {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').textContent =
                err.response?.data?.message || 'Login failed';
        });
}

function googleLogin() {
    window.location.href = `${apiBase}/auth/google/redirect`;
}
</script>

</body>
</html>
