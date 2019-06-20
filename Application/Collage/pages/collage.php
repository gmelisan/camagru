<?php $like = '/collage?id=' . $page["id"] . '&act=like'; ?>

<div class="collage-container">
    <img src="<?php echo $page["img_src"] ?>">
    <div class="info">
        <div class="heart-container">
            <a class="heart" href="<?php echo $like; ?>"> &hearts; </a>
            <?php echo $page["like_count"]; ?>
        </div>
        <div class="usertime">
            <span class="user"> by <?php echo $page["login"]; ?> </span>
            <br>
            <span clas="time"><?php echo $page["date"]; ?> </span>
        </div>
    </div>
    <?php if (!empty($page["comments"])): ?>
    <h3>Комментарии:</h3>

    <?php foreach ($page["comments"] as $comment): ?>
        <!-- <p>
            by <?php echo $comment["login"]; ?> at
            <?php echo $comment["date"]; ?>:
            <p>
            <?php echo $comment["text"]; ?>
            </p>
        </p> -->

        <div class="comments-container">
        <div class="comment">
            <div class="head">
                <div><?php echo $comment["login"]; ?></div>
                <div><?php echo $comment["date"]; ?></div>
            </div>
            <div class="text">
                <?php echo $comment["text"]; ?>
            </div>
        </div>
    </div>
    <?php endforeach;?>
    <?php else: ?>
        <h3> Комментариев нет</h3>
    <?php endif;?>
</div>