<?php
$actionfeed = ' ';
switch($item->type){
    case 'text':
        $actionfeed = 'fez um post';
    break;
    case 'photo':
        $actionfeed = 'postou uma foto';
    break;
    }
?>
<div class="box feed-item">
                        <div class="box-body">
                            <div class="feed-item-head row mt-20 m-width-20">
                                <div class="feed-item-head-photo">
                                    <a href="<?=$base;?>/perfil.php?id=<?=$item->user->id?>"><img src="<?=$base;?>/media/avatars/<?=$item->user->avatar?>" /></a>
                                </div>
                                <div class="feed-item-head-info">
                                    <a href="<?=$base;?>/profile.php"><span class="fidi-name"><?=$item->user->name;?></span></a>
                                    <span class="fidi-action"><?= $actionfeed; ?></span>
                                    <br/>
                                    <span class="fidi-date"><?=date('d/m/Y', strtotime($item->created_at))?></span>
                                </div>
                                <div class="feed-item-head-btn">
                                    <img src="<?=$base;?>/assets/images/more.png" />
                                </div>
                            </div>
                            <div class="feed-item-body mt-10 m-width-20"><?= $item->body ?></div>
                            <div class="feed-item-buttons row mt-20 m-width-20">
                                <div class="like-btn on">56</div>
                                <div class="msg-btn">3</div>
                            </div>
                            <div class="feed-item-comments">
                                
                                <div class="fic-item row m-height-10 m-width-20">
                                    <div class="fic-item-photo">
                                        <a href=""><img src="media/avatars/avatar.jpg" /></a>
                                    </div>
                                    <div class="fic-item-info">
                                        <a href="">Guilherme</a>
                                        Comentando no meu pr??prio post
                                    </div>
                                </div>

                                <div class="fic-item row m-height-10 m-width-20">
                                    <div class="fic-item-photo">
                                        <a href=""><img src="media/avatars/avatar.jpg" /></a>
                                    </div>
                                    <div class="fic-item-info">
                                        <a href="">guilherme</a>
                                        Muito legal, parab??ns!
                                    </div>
                                </div>

                                <div class="fic-answer row m-height-10 m-width-20">
                                    <div class="fic-item-photo">
                                        <a href=""><img src="media/avatars/avatar.jpg" /></a>
                                    </div>
                                    <input type="text" class="fic-item-field" placeholder="Escreva um coment??rio" />
                                </div>

                            </div>
                        </div>
                    </div>
