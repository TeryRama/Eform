<?php
if(!isset($dtdetail)) {
    if(isset($message)){
        for ($i=0;$i<$jmldtl;$i++) { ?>
            <tr>
                <td valign="top"><input name="chk[]" type="checkbox"/></td>
                <td>
                    <?php
                    if(count($parameter_cmp)>0){
                    ?>
                        <select name="parameter_uji[]" id="parameter_uji" class="parameter_uji">
                            <?php
                            if(isset($parameter_cmp)){
                                foreach($parameter_cmp as $dtparameter_uji){ ?>
                                  <option value="<?php echo $dtparameter_uji->parameter_uji?>" <?php if(isset($message)){echo set_select('parameter_uji',$dtparameter_uji->parameter_uji,'TRUE');}?>><?php echo $dtparameter_uji->parameter_uji?></option>
                            <?php }
                            }
                            ?>
                        </select>
                    <?php } else { ?>
                            <input type="text" size="30" name="parameter_uji[]"  id="parameter_uji" value="<?php echo set_value('parameter_uji['.$i.']');?>"/>
                    <?php } ?>

                </td>
                <td>
                    <input type="text" name="pembacaan1[]" id="pembacaan1" value="<?php echo set_value('pembacaan1['.$i.']');?>" size="23"/>
                </td>
                <td>
                    <input type="text" name="pembacaan2[]" id="pembacaan2" value="<?php echo set_value('pembacaan2['.$i.']');?>" size="23"/>
                </td>
                <td>
                    <input type="text" name="hasil1[]" id="hasil1" value="<?php echo set_value('hasil1['.$i.']');?>" size="23"/>
                </td>
                <td>
                    <input type="text" name="hasil2[]" id="hasil2" value="<?php echo set_value('hasil2['.$i.']');?>" size="23"/>
                </td>
            </tr>
        <?php } ?>
    <?php
    } else { ?>
    <tr>
      <td><input name="chk[]" type="checkbox"/></td>
      <td><select name="parameter_uji[]" class="parameter_uji" id="parameter_uji"></select></td>

      <td><input type="text" name="pembacaan1[]" id="pembacaan1" style="text-align: center;" size="20" value=""></td>

      <td><input type="text" name="pembacaan2[]" id="pembacaan2" style="text-align: center;" size="20" value=""></td>

      <td><input type="text" name="hasil1[]" id="hasil1" style="text-align: center;" size="20" value=""></td>

      <td><input type="text" name="hasil2[]" id="hasil2" style="text-align: center;" size="20" value=""></td>
    </tr>
    <?php } ?>
    <?php
    } else {
    foreach($dtdetail as $detail) {
      ?>
              <tr>
                <input type="hidden" name="detail_id[]" id="detail_id" value="<?php echo $detail->detail_id;?>" size="1"/>

                <td><input name="chk[]" type="checkbox" value="<?php echo $detail->detail_id;?> "/></td>
                <td>
                    <select name="parameter_uji[]" id="parameter_uji" class="parameter_uji">
                        <option value="<?php echo $detail->parameter_uji;?>"><?php echo $detail->parameter_uji;?></option>
                        <?php
                        if(isset($parameter_cmp)){
                            foreach($parameter_cmp as $dtparameter_uji){ ?>
                              <option value="<?php echo $dtparameter_uji->parameter_uji?>"><?php echo $dtparameter_uji->parameter_uji?></option>
                        <?php }
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <input type="text" name="pembacaan1[]" id="pembacaan1" value="<?php echo $detail->pembacaan1;?>" size="23"/>
                </td>
                <td>
                    <input type="text" name="pembacaan2[]" id="pembacaan2" value="<?php echo $detail->pembacaan2;?>" size="23"/>
                </td>
                <td>
                    <input type="text" name="hasil1[]" id="hasil1" value="<?php echo $detail->hasil1;?>" size="23"/>
                </td>
                <td>
                    <input type="text" name="hasil2[]" id="hasil2" value="<?php echo $detail->hasil2;?>" size="23"/>
                </td>
              </tr>
      <?php }}?>