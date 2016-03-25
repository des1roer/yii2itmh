<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'itmh',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            /*
              /user/registration/register Displays registration form
              /user/registration/resend Displays resend form
              /user/registration/confirm Confirms a user (requires id and token query params)
              /user/security/login Displays login form
              /user/security/logout Logs the user out (available only via POST method)
              /user/recovery/request Displays recovery request form
              /user/recovery/reset Displays password reset form (requires id and token query params)
              /user/settings/profile Displays profile settings form
              /user/settings/account Displays account settings form (email, username, password)
              /user/settings/networks Displays social network accounts settings page
              /user/profile/show Displays user's profile (requires id query param)
              /user/admin/index Displays user management interface
             */
            $user = \Yii::$app->user;
            $isAdmin = $user->can('admin');
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    //['label' => 'Home', 'url' => ['/site/index']],
                    //['label' => 'About', 'url' => ['/site/about']],
                    //['label' => 'Contact', 'url' => ['/site/contact']],
                    ['label' => 'Admin', 'items' => [
                            ['label' => 'API', 'url' => ['/user']],
                            ['label' => 'Аккаунты', 'url' => ['/user/admin']],
                            ['label' => 'gii', 'url' => ['/gii']],
                        ], 'visible' => $isAdmin], // check if user is an admin 
                    ['label' => 'Video', 'items' => [
                            ['label' => 'video', 'url' => ['/video/video']],
                            ['label' => 'country', 'url' => ['/video/country']],
                            ['label' => 'actor', 'url' => ['/video/actor']],
                            ['label' => 'director', 'url' => ['/video/director']],
                            ['label' => 'genre', 'url' => ['/video/genre']],
                        ], 'visible' => $isAdmin], // check if user is an admin 
                    Yii::$app->user->isGuest ?
                            ['label' => 'Login', 'url' => ['/user/login']] : // or ['/user/login-email']
                            ['label' => 'Logout (' . Yii::$app->user->displayName . ')',
                        'url' => ['/user/logout'],
                        'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
            ?>

            <div class="container">
            <?=
            Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])
            ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; des1roer <?= date('Y') ?></p>

                
            </div>
        </footer>

<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
