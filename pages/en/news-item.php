<?php
session_start();
include('../../components/function.php');

$news_items = getJsonContent('news', 'en');
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $news_item = $news_items->$id;
    if (isset($news_item->reactions)) {
        $reactions = $news_item->reactions;
    }
    if (!$news_item) {
        header('Location: ./news.php');
    }
} else {
    header('Location: ./news.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../../components/head.php') ?>
    <title><?= $news_item->title ?></title>
</head>

<body>
    <?php include_once('../../components/en/header.php') ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1><?= $news_item->title ?></h1>
            </div>
            <div class="col-12 col-md-6">
                <img src="../../<?= $news_item->image ?>" class="image-fluid news-item-img" alt="<?= $news_item->title ?>">
                <div class="news-author">
                    <h4><?= $news_item->author ?></h4>
                </div>
                <div class="news-text mb-3">
                    <?= nl2br($news_item->article) ?>
                </div>

            </div>
            <div class="col-12 col-md-6">
                <h3 class="mt-0">Leave a comment</h3> <!-- geplaatste reacties-->
                <div class="reaction-container">
                    <?php
                    if (isset($reactions)) {
                        foreach ($reactions as $key => $reaction) {
                    ?>
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h5 class="reaction-name mt-0"><?= $reaction->author ?>:</h5><span class="reaction-date "><?= date('d-m-Y H:i', $key) ?></span>
                                    <div class="reaction">
                                        <?= nl2br($reaction->reaction) ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <h4 class="text-center">There are currently no comments</h4>

                    <?php
                    }
                    ?>
                </div>
                <!-- reactie typen -->
                <h3 class="mt-3">
                    <label for="reaction">Write your comment
                        <?php
                        if (isset($_GET["error"]) && $_GET["error"] == "message") { //foutmelding als bericht leeg is
                        ?>
                        <span class="error">Your message was not filled in</span>
                        <?php
                        }
                        ?>
                    </label>
                </h3>
                <form action="../../controllers/create_reaction.php" class="reactionForm" method="post">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="hidden" name="userLang" value="en">
                    <input type="hidden" name="author" value="<?= $_SESSION['fullName'] ?>">
                    <textarea id="reaction" class="form-control" name="reaction" placeholder="Write your message here..."></textarea>
                    <input type="submit" class="btn btn-custom mt-2 mb-2" height="80" value="Send">
                </form>
            </div>
        </div>
    </div>
    <?php include_once('../../components/en/footer.php') ?>
</body>

</html>