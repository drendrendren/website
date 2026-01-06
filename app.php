<?php
    // 모든 php 오류 숨겨줌
    error_reporting(0);
    ini_set('display_errors', 0);

    // GET 파라미터
    $get_app_name = isset($_GET['name']) ? $_GET['name'] : '';

    // JSON 파일 읽기
    $json_data = file_get_contents('./assets/datas/app_link_data.json');
    $apps = json_decode($json_data, true); // true -> 배열로 변환

    // 앱 찾기
    $selected_app = null;

    foreach ($apps as $app) {
        if ($app['name'] === $get_app_name) {
            $selected_app = $app;
            break;
        }
    }

    if(isset($selected_app)){
        // app data 조회
        $app_name = htmlspecialchars($selected_app['name']);
        $app_subtitle = htmlspecialchars($selected_app['subtitle']);
        $app_promotion_text = htmlspecialchars($selected_app['promotion_text']);
        $app_description = htmlspecialchars($selected_app['description']);
        $app_logo = htmlspecialchars($selected_app['logo']);

        // app link
        // list로 가져와서 하나씩 조회
        $app_link_list = $selected_app['links'];
        $play_store_link =  !empty($app_link_list['play'])? htmlspecialchars($app_link_list['play']) : '';
        $app_store_link =  !empty($app_link_list['appstore'])? htmlspecialchars($app_link_list['appstore']): '';
        $yt_link =  !empty($app_link_list['youtube'])? htmlspecialchars($app_link_list['youtube']) : '';
        $instagram_link =  !empty($app_link_list['instagram'])? htmlspecialchars($app_link_list['instagram']) : '';
    }else{
        // index로 redirect
        echo '<script>window.location.href="./index";</script>';
    }
?>

<!DOCTYPE html>
<html lang="ko-KR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $app_subtitle; ?>">
    <meta name="robots" content="index,follow">
    <meta property="og:locale" content="ko_KR">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $app_name; ?>">
    <meta property="og:description" content="<?php echo $app_subtitle; ?>">
    <meta property="og:url" content="https://www.drendrendren.com/app?name=<?php echo $app_name; ?>">
    <meta property="og:site_name" content="drendrendren">
    <meta property="og:image" content="https://www.drendrendren.com/assets/images/og/og_image.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <title><?php echo $app_name; ?></title>
    <link rel="icon" type="image/png" href="./assets/images/logo/favicon_logo.png">
    <link rel="stylesheet" href="./styles/palette.css">
    <link rel="stylesheet" href="./styles/global.css">
    <link rel="stylesheet" href="./styles/app.css">
</head>

<body>
    <nav>
        <a href="./index" rel="noopener noreferrer">
            <img src="./assets/images/logo/nav_logo.png" alt="drendrendren logo" class="nav-logo-img">
        </a>
    </nav>

    <main>
        <header>
            <div>
                <img src="./assets/images/logo/app/<?php echo $app_logo; ?>.png" alt="<?php echo $app_name; ?>" class="app-info-img">
            </div>

            <div>
                <h1>
                    <?php echo $app_name; ?>
                </h1>

                <h2>
                    <?php echo nl2br($app_subtitle); ?>
                </h2>
            </div>
        </header>

        <section class="content-wrapper">
            <div>
                <h3>
                    <?php echo nl2br($app_promotion_text); ?>
                </h3>

                <p>
                    <?php echo nl2br($app_description); ?>
                </p>
            </div>

            <?php if (!empty($app_link_list)): ?>
                <p>
                    <!-- play store link -->
                    <?php if (!empty($play_store_link)): ?>
                        <a href="https://play.google.com/store/apps/details?id=<?php echo htmlspecialchars($play_store_link); ?>" target="_blank" rel="noopener noreferrer" class="app-info-link">              
                            <img src="./assets/images/logo/etc/playstore_download_logo.png" alt="playstore download logo" class="app-info-link-img">
                        </a>
                    <?php endif; ?>
                    <!-- app store link -->
                    <?php if (!empty($app_store_link)): ?>
                        <a href="https://apps.apple.com/app/<?php echo htmlspecialchars($app_store_link); ?>" target="_blank" rel="noopener noreferrer" class="app-info-link">
                            <img src="./assets/images/logo/etc/appstore_download_logo.svg" alt="appstore download logo" class="app-info-link-img">
                        </a>
                    <?php endif; ?>
                    <!-- yt link -->
                    <?php if (!empty($yt_link)): ?>
                        <a href="https://www.youtube.com/@<?php echo htmlspecialchars($yt_link); ?>" target="_blank" rel="noopener noreferrer" class="app-info-link">
                            <img src="./assets/images/logo/etc/yt_logo.png" alt="yt logo" class="app-info-link-img">
                        </a>
                    <?php endif; ?>
                    <!-- instagram link -->
                    <?php if (!empty($instagram_link)): ?>
                        <a href="https://www.instagram.com/<?php echo htmlspecialchars($instagram_link); ?>" target="_blank" rel="noopener noreferrer" class="app-info-link">
                            <img src="./assets/images/logo/etc/instagram_logo.png" alt="instagram logo" class="app-info-link-img">
                        </a>
                    <?php endif; ?>
                </p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <div>
            <span>ᕕ( ᐛ )ᕗ<br>누구든, 어떤 이야기든 편하게 연락 주세요!</span>
        </div>

        <div class="footer-link-wrapper">
            <div>
                <a href="mailto:drendrendrencom@gmail.com" target="_blank" rel="noopener noreferrer"
                    class="footer-link">drendrendrencom@gmail.com</a>
            </div>

            <div>
                <a href="https://github.com/drendrendren" target="_blank" rel="noopener noreferrer" class="footer-link">
                    <img src="./assets/images/logo/etc/github_logo.png" alt="github logo" class="footer-link-img"></a>
            </div>
        </div>

        <div class="footer-copyright-block">
            <span class="footer-copyright">© <span id="footerCopyrightYear"></span> drendrendren. All rights
                reserved.</span>
        </div>
    </footer>

    <script src="./scripts/footer.js" async></script>
</body>

</html>