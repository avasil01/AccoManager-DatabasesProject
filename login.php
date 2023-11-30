<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AccoManager - Login</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
  <header>
    <nav>
      <ul>
        <img src="logo.png" class="img-style">
        <li>
          <label for="language-select">Language:</label>
          <select name="language" id="language-select">
            <option value="en">English</option>
            <option value="gr">Greek</option>
          </select>
        </li>
      </ul>
    </nav>
  </header>

  <div class="login-wrapper">
    <form action="login_db.php" method="POST" class="login-form" style="width: 80%; margin: 0 auto; display: flex; flex-direction: column; align-items: center;">
        <h1>Login</h1>
        <div class="input-box" style="width: 100%; margin-bottom: 10px;">
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="input-box" style="width: 100%; margin-bottom: 10px;">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <div class="role-selection">
            <label>
            <input type="radio" name="role" value="user" checked> User
            </label>
            <label>
            <input type="radio" name="role" value="admin"> Admin
            </label>
            <label>
            <input type="radio" name="role" value="system-admin"> System admin
            </label>
        </div>

      <button type="submit" class="button-19" style="width: 30%">Submit</button>
    </form>
  </div>

  <footer>
    <p>&copy; 2023 AccoManager. All rights reserved.</p>
  </footer>
</body>
</html>
