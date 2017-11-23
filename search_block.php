<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Поиск по параметрам</h4>
      </div>
      <div class="modal-body">
        <div id="search" class="col-md-4 col-lg-4 ">
        <form method="GET" action="search_filter.php" class = "group-search">
          <table style="width: auto;">
          <?php
             $result = mysql_query("SELECT main_category FROM models",$link);
            echo'
              <tr><td id="table-search">Категория: ';
            if(mysql_num_rows($result) > 0){
              $row = mysql_fetch_array($result);
              do{
                  echo' <a href="view_cat.php?cat='.$row["main_category"].'">'.$row[main_category].'</a> ';
              }while($row = mysql_fetch_array($result));
            }
            echo'
              </td></tr> ';
            $result = mysql_query("SELECT category FROM models",$link);
            echo'
              <tr><td id="table-search">';
            if(mysql_num_rows($result) > 0){
              $row = mysql_fetch_array($result);
              do{
                  echo' <a href="view_cat.php?cat='.$row["category"].'">'.$row[category].'</a> ';
              }while($row = mysql_fetch_array($result));
            }
            echo'
              </td></tr> ';
              $result = mysql_query("SELECT scale FROM models",$link);
            echo'
              <tr><td id="table-search">Масштаб: ';
            if(mysql_num_rows($result) > 0){
              $row = mysql_fetch_array($result);
              do{
                  echo' <a href="view_cat.php?sca='.$row["scale"].'">'.$row[scale].'</a> ';
              }while($row = mysql_fetch_array($result));
            }
            echo'
              </td></tr> ';
              $result = mysql_query("SELECT mark FROM models",$link);
            echo'
              <tr><td id="table-search">Марка: ';
            if(mysql_num_rows($result) > 0){
              $row = mysql_fetch_array($result);
              do{
                  echo' <a href="view_cat.php?mar='.$row["mark"].'">'.$row[mark].'</a> ';
              }while($row = mysql_fetch_array($result));
            }
            echo'
              </td></tr> ';
              $result = mysql_query("SELECT brand FROM models",$link);
            echo'
              <tr><td id="table-search">Производитель: ';
            if(mysql_num_rows($result) > 0){
              $row = mysql_fetch_array($result);
              do{
                  echo' <a href="view_cat.php?bra='.$row["brand"].'">'.$row[brand].'</a> ';
              }while($row = mysql_fetch_array($result));
            }
            echo'
              </td></tr> ';
            ?>  
            <tr><td><hr style="border-width: 5px;">
                    <p><strong>Групповой поиск по каталогу</strong></p>
                      <?php
                        $ID = mysql_query("SELECT ID FROM models",$link);
                        $result = mysql_query("SELECT category FROM models",$link);
                        if(mysql_num_rows($result) > 0){
                          $row = mysql_fetch_array($result);
                          echo'<p><select class="btn btn-default" data-style="btn-primary" name="category"> ';
                          do{
                              echo'<option value="'.$row[category].'">'.$row[category].'</option>';
                          }while($row = mysql_fetch_array($result));
                        }
                        echo'</select></p>';
                        $result = mysql_query("SELECT scale FROM models",$link);
                        if(mysql_num_rows($result) > 0){
                          $row = mysql_fetch_array($result);
                          echo'<p><select name="scale" class="btn btn-default"> ';
                          do{
                              echo'<option value="'.$row[scale].'">'.$row[scale].'</option>';
                          }while($row = mysql_fetch_array($result));
                        }
                        echo'</select></p>';
                        $result = mysql_query("SELECT mark FROM models",$link);
                        if(mysql_num_rows($result) > 0){
                          $row = mysql_fetch_array($result);
                          echo'<p><select name="mark" class="btn btn-default"> ';
                          do{
                            if($row[mark] != "")
                              echo'<option value="'.$row[mark].'">'.$row[mark].'</option>';
                          }while($row = mysql_fetch_array($result));

                        }
                        echo'</select></p>';
                        $result = mysql_query("SELECT brand FROM models",$link);
                        if(mysql_num_rows($result) > 0){
                          $row = mysql_fetch_array($result);
                          echo'<p><select name="brand" class="btn btn-default"> ';
                          do{
                            if($row[brand] != "")
                              echo'<option value="'.$row[brand].'">'.$row[brand].'</option>';
                          }while($row = mysql_fetch_array($result));
                        }
                        echo'</select></p>';
                      ?>
                  </td></tr>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success"><i class="fa fa-search"></i>Поиск</button>
        </form>
      </div>
    </div>
  </div>
</div>