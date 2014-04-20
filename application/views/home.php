<form name='frmSearchTeam'  class="navbar-form pull-left" action="search" method="post" id='idSearchTeam'>
    <input type='text' name='search_team' value='' class='input-xxlarge search-query'  data-loading-text="Loading..." placeholder='Search Team'/>
    <input type='submit' name='submit' value='search' class='btn btn-primary'/>
 <a class="btn" title="" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus." data-placement="top" data-toggle="popover" href="#" data-original-title="Popover on top">Popover on top</a>
    
</form>


    
    <div id="idListTeams">
        <?php if (count($teams_list) > 0) { ?>
            <div id="listTeamsCotainer">
                <div class="span9" id="idListTeams">
                    
                    <?php $flag_cout=1;
                          $temp_class='';
                          foreach($teams_list as $team){
                              $team->status=($team->status)?'Ready':'Not Ready';
                              $temp_class=($team->status=='Ready')?'badge-success':'badge-important';
                    ?>
                        
                    <?php  if($flag_cout==1){ ?><div class="row-fluid"><?php }else if(!empty($team) && $flag_cout==4 ){?>
                    </div><div class="row-fluid">
                    <?php }?>
                        <div class="span4 contact-main-office ">
                            <h2><?php echo ucfirst($team->name)?></h2>
                            <span class="badge <?php echo $temp_class;?>"><?php echo $team->status;?></span>
                            <p>Team Description</p>
                            <p><a href="#" id="btnListTeamConnect_<?php echo $team->id?>" class="btn btn-primary">Connect »</a></p>
                        </div><!--/span-->
                    <?php if($flag_cout==4)$flag_cout=1;$flag_cout++;}?>
                        
                </div>

            </div>

        <?php } else if ($flag_searchteam) { ?>
            <div class="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                No team found. Pleae modify your search key word for better result.
            </div>
        <?php } ?>

    </div>

        




