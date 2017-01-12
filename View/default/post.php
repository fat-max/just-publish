<h1><?php echo $posts[0]->title ?></h1>
<?php echo $posts[0]->content ?>
<ul>
    <li><?php echo $posts[0]->full_name ?></li>
    <li><?php echo $posts[0]->publish_time ?: $posts[0]->created_at ?></li>
</ul>

<?php foreach ($posts as $key => $post): ?>
    <hr />
    <p>From: <?php echo $post->name ?></p>
    <p><?php echo $post->comment ?></p>
<?php endforeach; ?>