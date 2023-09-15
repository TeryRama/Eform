<?php
$this->load->view('template/head');
?>
        <!-- DATA TABLES -->
      <link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css')?>" rel="stylesheet" type="text/css" />
  <!-- Theme style -->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

<?php
$this->load->view('template/topbar2');
?>
<style type="text/css">
    ol.organizational-chart,
ol.organizational-chart ol,
ol.organizational-chart li,
ol.organizational-chart li > div {
    position: relative;
}

ol.organizational-chart,
ol.organizational-chart ol {
    list-style: none;
    margin: 0;
    padding: 0;
}

ol.organizational-chart {
    text-align: center;
}

ol.organizational-chart ol {
    padding-top: 1em;
}

ol.organizational-chart ol:before,
ol.organizational-chart ol:after,
ol.organizational-chart li:before,
ol.organizational-chart li:after,
ol.organizational-chart > li > div:before,
ol.organizational-chart > li > div:after {
    background-color: #b7a6aa;
    content: '';
    position: absolute;
}

ol.organizational-chart ol > li {
    padding: 1em 0 0 1em;
}

ol.organizational-chart > li ol:before {
    height: 1em;
    left: 50%;
    top: 0;
    width: 3px;
}

ol.organizational-chart > li ol:after {
    height: 3px;
    left: 3px;
    top: 1em;
    width: 50%;
}

ol.organizational-chart > li ol > li:not(:last-of-type):before {
    height: 3px;
    left: 0;
    top: 2em;
    width: 1em;
}

ol.organizational-chart > li ol > li:not(:last-of-type):after {
    height: 100%;
    left: 0;
    top: 0;
    width: 3px;
}

ol.organizational-chart > li ol > li:last-of-type:before {
    height: 3px;
    left: 0;
    top: 2em;
    width: 1em;
}

ol.organizational-chart > li ol > li:last-of-type:after {
    height: 2em;
    left: 0;
    top: 0;
    width: 3px;
}

ol.organizational-chart li > div {
    background-color: #fff;
    border-radius: 3px;
    min-height: 2em;
    padding: 0.5em;
}

/*** PRIMARY ***/
ol.organizational-chart > li > div {
    background-color: #a2ed56;
    margin-right: 1em;
}

ol.organizational-chart > li > div:before {
    bottom: 2em;
    height: 3px;
    right: -1em;
    width: 1em;
}

ol.organizational-chart > li > div:first-of-type:after {
    bottom: 0;
    height: 2em;
    right: -1em;
    width: 3px;
}

ol.organizational-chart > li > div + div {
    margin-top: 1em;
}

ol.organizational-chart > li > div + div:after {
    height: calc(100% + 1em);
    right: -1em;
    top: -1em;
    width: 3px;
}

/*** SECONDARY ***/
ol.organizational-chart > li > ol:before {
    left: inherit;
    right: 0;
}

ol.organizational-chart > li > ol:after {
    left: 0;
    width: 100%;
}

ol.organizational-chart > li > ol > li > div {
    background-color: #83e4e2;
}

/*** TERTIARY ***/
ol.organizational-chart > li > ol > li > ol > li > div {
    background-color: #fd6470;
}

/*** QUATERNARY ***/
ol.organizational-chart > li > ol > li > ol > li > ol > li > div {
    background-color: #fca858;
}

/*** QUINARY ***/
ol.organizational-chart > li > ol > li > ol > li > ol > li > ol > li > div {
    background-color: #fddc32;
}

@media only screen and ( min-width: 64em ) {

    ol.organizational-chart {
        margin-left: -1em;
        margin-right: -1em;
    }

    /* PRIMARY */
    ol.organizational-chart > li > div {
        display: inline-block;
        float: none;
        margin: 0 1em 1em 1em;
        vertical-align: bottom;
    }

    ol.organizational-chart > li > div:only-of-type {
        margin-bottom: 0;
        width: calc((100% / 1) - 2em - 4px);
    }

    ol.organizational-chart > li > div:first-of-type:nth-last-of-type(2),
    ol.organizational-chart > li > div:first-of-type:nth-last-of-type(2) ~ div {
        width: calc((100% / 2) - 2em - 4px);
    }

    ol.organizational-chart > li > div:first-of-type:nth-last-of-type(3),
    ol.organizational-chart > li > div:first-of-type:nth-last-of-type(3) ~ div {
        width: calc((100% / 3) - 2em - 4px);
    }

    ol.organizational-chart > li > div:first-of-type:nth-last-of-type(4),
    ol.organizational-chart > li > div:first-of-type:nth-last-of-type(4) ~ div {
        width: calc((100% / 4) - 2em - 4px);
    }

    ol.organizational-chart > li > div:first-of-type:nth-last-of-type(5),
    ol.organizational-chart > li > div:first-of-type:nth-last-of-type(5) ~ div {
        width: calc((100% / 5) - 2em - 4px);
    }

    ol.organizational-chart > li > div:before,
    ol.organizational-chart > li > div:after {
        bottom: -1em!important;
        top: inherit!important;
    }

    ol.organizational-chart > li > div:before {
        height: 1em!important;
        left: 50%!important;
        width: 3px!important;
    }

    ol.organizational-chart > li > div:only-of-type:after {
        display: none;
    }

    ol.organizational-chart > li > div:first-of-type:not(:only-of-type):after,
    ol.organizational-chart > li > div:last-of-type:not(:only-of-type):after {
        bottom: -1em;
        height: 3px;
        width: calc(50% + 1em + 3px);
    }

    ol.organizational-chart > li > div:first-of-type:not(:only-of-type):after {
        left: calc(50% + 3px);
    }

    ol.organizational-chart > li > div:last-of-type:not(:only-of-type):after {
        left: calc(-1em - 3px);
    }

    ol.organizational-chart > li > div + div:not(:last-of-type):after {
        height: 3px;
        left: -2em;
        width: calc(100% + 4em);
    }

    /* SECONDARY */
    ol.organizational-chart > li > ol {
        display: flex;
        flex-wrap: nowrap;
    }

    ol.organizational-chart > li > ol:before,
    ol.organizational-chart > li > ol > li:before {
        height: 1em!important;
        left: 50%!important;
        top: 0!important;
        width: 3px!important;
    }

    ol.organizational-chart > li > ol:after {
        display: none;
    }

    ol.organizational-chart > li > ol > li {
        flex-grow: 1;
        padding-left: 1em;
        padding-right: 1em;
        padding-top: 1em;
    }

    ol.organizational-chart > li > ol > li:only-of-type {
        padding-top: 0;
    }

    ol.organizational-chart > li > ol > li:only-of-type:before,
    ol.organizational-chart > li > ol > li:only-of-type:after {
        display: none;
    }

    ol.organizational-chart > li > ol > li:first-of-type:not(:only-of-type):after,
    ol.organizational-chart > li > ol > li:last-of-type:not(:only-of-type):after {
        height: 3px;
        top: 0;
        width: 50%;
    }

    ol.organizational-chart > li > ol > li:first-of-type:not(:only-of-type):after {
        left: 50%;
    }

    ol.organizational-chart > li > ol > li:last-of-type:not(:only-of-type):after {
        left: 0;
    }

    ol.organizational-chart > li > ol > li + li:not(:last-of-type):after {
        height: 3px;
        left: 0;
        top: 0;
        width: 100%;
    }

}
</style>


<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <fieldset>
                <legend class="text-warning">DAFTAR FORM APLIKASI E-Form WHS<a href="#"><img src="" width="8" height="20"></a></legend>
            </fieldset>
        </div>
    </div>

    <br>

    

    <div class="row">
        <div class="col-lg-12" style="text-align: center;">
          <?php if(isset($struktur_qad)){ ?>
              <ol class="organizational-chart">
                <li>
                <?php
                foreach($struktur_qad as $struktur_qad){ ?>
                <div><h1><?php echo $struktur_qad->level;?></h1></div>
                  <?php
                  if(isset($struktur_qad->children)){ ?>
                    <ol>
                    <?php
                    foreach($struktur_qad->children as $child){ ?>
                      <li>
                        <div><h1><?php echo $child->level_bag;?></h1></div>
                        <?php
                        if(isset($child->children2)){
                          echo '<ol>';
                          foreach($child->children2 as $child2){ ?>
                          <li>
                                <div><h1><?php echo $child2->level_bag2;?></h1></div>
                                <?php
                                if(isset($child2->children3)){
                                  echo '<ol>';
                                  foreach($child2->children3 as $child3){ ?>
                                    <li>
                                     <div><h1><?php echo $child3->level_bag3;?></h1></div>
                                    </li>
                                  <?php } ?>
                                  </ol>
                                <?php
                                  }
                                ?>
                          </li>
                          <?php
                          }
                          echo '</ol>';
                        }
                        ?>
                      </li>
                    <?php
                    } ?>
                    </ol>
                    <?php
                  }
                }
                ?>
              </li>
              </ol>
          <?php
          }else{}
          ?>
            <ol class="organizational-chart">
              <li>
                <div><h1>Primary</h1></div>
                <div><h1>Primary</h1></div>
                <div><h1>Primary</h1></div>
                <ol>
                  <li>
                    <div><h2>Secondary</h2></div>
                    <ol>
                     <li><div><h3>Tertiary</h3></div></li>
                     <li><div><h3>Tertiary</h3>
                        </div>
                        <ol>
                          <li>
                            <div>
                              <h4>Quaternary</h4>
                            </div>
                          </li>
                          <li>
                            <div>
                              <h4>Quaternary</h4>
                            </div>
                            <ol>
                              <li>
                                <div>
                                  <h5>Quinary</h5>
                                </div>
                              </li>
                              <li>
                                <div>
                                  <h5>Quinary</h5>
                                </div>
                                <ol>
                                  <li>
                                    <div>
                                      <h6>Senary</h6>
                                    </div>
                                  </li>
                                </ol>
                              </li>
                            </ol>
                          </li>
                          <li>
                            <div>
                              <h4>Quaternary</h4>
                            </div>
                          </li>
                        </ol>
                      </li>
                      <li>
                        <div>
                          <h3>Tertiary</h3>
                        </div>
                      </li>
                    </ol>
                  </li>
                  <li>
                    <div>
                      <h2>Secondary</h2>
                    </div>
                    <ol>
                      <li>
                        <div>
                          <h3>Tertiary</h3>
                        </div>
                      </li>
                      <li>
                        <div>
                          <h3>Tertiary</h3>
                        </div>
                        <ol>
                          <li>
                            <div>
                              <h4>Quaternary</h4>
                            </div>
                          </li>
                          <li>
                            <div>
                              <h4>Quaternary</h4>
                            </div>
                          </li>
                          <li>
                            <div>
                              <h4>Quaternary</h4>
                            </div>
                          </li>
                        </ol>
                      </li>
                    </ol>
                  </li>
                  <li>
                    <div>
                      <h2>Secondary</h2>
                    </div>
                    <ol>
                      <li>
                        <div>
                          <h3>Tertiary</h3>
                        </div>
                        <ol>
                          <li>
                            <div>
                              <h4>Quaternary</h4>
                            </div>
                            <ol>
                              <li>
                                <div>
                                  <h5>Quinary</h5>
                                </div>
                                <ol>
                                  <li>
                                    <div>
                                      <h6>Senary</h6>
                                    </div>
                                  </li>
                                  <li>
                                    <div>
                                      <h6>Senary</h6>
                                    </div>
                                  </li>
                                </ol>
                              </li>
                              <li>
                                <div>
                                  <h5>Quinary</h5>
                                </div>
                              </li>
                            </ol>
                          </li>
                        </ol>
                      </li>
                      <li>
                        <div>
                          <h3>Tertiary</h3>
                        </div>
                      </li>
                      <li>
                        <div>
                          <h3>Tertiary</h3>
                        </div>
                      </li>
                    </ol>
                  </li>
                  <li>
                    <div>
                      <h2>Secondary</h2>
                    </div>
                    <ol>
                      <li>
                        <div>
                          <h3>Tertiary</h3>
                        </div>
                      </li>
                      <li>
                        <div>
                          <h3>Tertiary</h3>
                        </div>
                      </li>
                      <li>
                        <div>
                          <h3>Tertiary</h3>
                        </div>
                        <ol>
                          <li>
                            <div>
                              <h4>Quaternary</h4>
                            </div>
                          </li>
                          <li>
                            <div>
                              <h4>Quaternary</h4>
                            </div>
                          </li>
                        </ol>
                      </li>
                      <li>
                        <div>
                          <h3>Tertiary</h3>
                        </div>
                      </li>
                      <li>
                        <div>
                          <h3>Tertiary</h3>
                        </div>
                      </li>
                    </ol>
                  </li>
                </ol>
              </li>
            </ol> 
        </div>
    </div>

</section><!-- /.content -->

<?php
$this->load->view('template/js2');
?>

<!-- DATA TABES SCRIPT -->
<!-- <script src="<?php //echo base_url('assets/fixedtblhdrlftcol/jquery.fixedTblHdrLftCol.js')?>" type="text/javascript"></script>
 -->

<!-- page script -->

<!-- <script>
      $(function() {
        $('table').fixedTblHdrLftCol({
          scroll: {
            height: '200px',
            width: '550px'
          }
        });
      });
    </script> -->

<?php
$this->load->view('template/foot2');
?>