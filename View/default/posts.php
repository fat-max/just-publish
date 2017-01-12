<?php foreach ($posts as $key => $post): ?>
    <h1><a href="/main/post?id=<?php echo $post->id ?>"><?php echo $post->title ?></a></h1>
    <?php echo $post->content ?>
    <ul>
        <li><a href="/main/post?id=<?php echo $post->id ?>"><?php echo $post->comments ?> comments</a></li>
        <li><?php echo $post->full_name ?></li>
        <li><?php echo $post->publish_time ?: $post->created_at ?></li>
    </ul>
<?php endforeach; ?>