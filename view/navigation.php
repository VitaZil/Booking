<div class="nav-container nav-full">
    <div>
        <a class="nav-link" href="/">HOME</a>
        <a class="nav-link" href="/apartments">ALL APARTMENTS</a>
        <a class="nav-link" href="/apartments/new">ADD NEW APARTMENT</a>
        <a class="nav-link" href="/apartments/edit">CHANGE APARTMENT</a>
    </div>
    <div>
        <?php if (!isset($_SESSION['username'])): ?>
            <a class="nav-link" href="/register">REGISTER</a>
            <a class="nav-link" href="/login">LOGIN</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['username'])): ?>
            <span class="user-nav"><ion-icon name="person"></ion-icon> <?= $_SESSION['username'] ?></span>
            <a class="nav-link" href="/logout">LOGOUT</a>
        <?php endif; ?>
    </div>
</div>

<div class="nav-container nav-min">
    <div>
        <a class="nav-link" href="/">HOME</a>
        <a class="nav-link" href="/apartments">ALL</a>
        <a class="nav-link" href="/apartments/new">NEW</a>
        <a class="nav-link" href="/apartments/edit">CHANGE</a>
    </div>
    <div>
        <?php if (!isset($_SESSION['username'])): ?>
            <a class="nav-link" href="/register">REGISTER</a>
            <a class="nav-link" href="/login">LOGIN</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['username'])): ?>
            <span class="user-nav"><ion-icon name="person"></ion-icon> <?= $_SESSION['username'] ?></span>
            <a class="nav-link" href="/logout">LOGOUT</a>
        <?php endif; ?>
    </div>
</div>