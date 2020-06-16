<div id="new-post">
    <h1>New Post</h1>
    <div id="">
        <form method="post" id="post_form">
            <input type="text" name="header" id="post_header" placeholder="Heading">
            <textarea name="body" id="post_body" placeholder="Content"></textarea>
            <input type="file" name="media" id="post_media">
            <button type="submit" class="btn btn-wide" id="post_content">Post</button>
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['USER_ID'] ?>">
        </form>
        <script src="js/new_post.js"></script>
    </div>
</div>