<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up</title>
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
.message { margin-top: 10px; text-align:center; }
.toggle { text-align:center; margin-top:15px; }
.toggle a { color: #007bff; text-decoration: none; }
.toggle a:hover { text-decoration: underline; }
.resend-btn { background:#007bff; margin-top: 10px; display: none; }
.resend-btn:hover { background:#0056b3; }
</style>
</head>
<body>

<div class="container">
    <h2>Sign Up</h2>

    <form id="signup-form" onsubmit="event.preventDefault(); signup();">
        <input type="text" id="signup-name" placeholder="Name" required>
        <input type="email" id="signup-email" placeholder="Email" required>
        <input type="password" id="signup-password" placeholder="Password" required>
        <button type="submit">Sign Up</button>
    </form>

    <button id="resend-btn" class="google-btn resend-btn" onclick="resendVerificationEmail()">
        Resend Verification Email
    </button>

    <button class="google-btn" onclick="googleLogin()">Sign In with Google</button>

    <div class="toggle">
        Already have an account? <a href="{{ route('login') }}">Sign In</a>
    </div>

    <div class="message" id="message"></div>
</div>

<script>
const apiBase = '/api';

function signup() {
    const name = document.getElementById('signup-name').value;
    const email = document.getElementById('signup-email').value;
    const password = document.getElementById('signup-password').value;

    axios.post(`${apiBase}/signup`, { name, email, password })
        .then(res => {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').textContent =
                'Sign Up successful! Please verify your email.';

            document.getElementById('resend-btn').style.display = 'block';
        })
        .catch(err => {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').textContent =
                err.response?.data?.message || 'Sign Up failed';
        });
}

function resendVerificationEmail() {
    const email = document.getElementById('signup-email').value;

    if (!email) {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').textContent = 'Please enter your email first';
        return;
    }

    axios.post(`${apiBase}/email/verification-notification`, { email })
        .then(res => {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').textContent = res.data.message;
        })
        .catch(err => {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').textContent =
                err.response?.data?.message || 'Failed to resend';
        });
}

function googleLogin() {
    window.location.href = `${apiBase}/auth/google/redirect`;
}
</script>

</body>
</html>
