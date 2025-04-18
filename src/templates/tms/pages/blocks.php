<?php
$blocks_combined = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/combined/blocks?limit=10&order=height&direction=descending&confirmations=le10000');
$rounds_combined = getData('http://'.$pool_configuration['ip'].':'.$pool_configuration['port'].'/api/v2/'.$pool_configuration['name'].'/combined/rounds');
?>
<div class="text_header">Blocks</div>
<div class="text_normal">List of mined blocks and corresponding rounds.</div>
<hr>
<div class="list_wrap">
  <?php
  foreach ($blocks_combined as $block) {
    ?>
    <div class="list_wrap gap_small">
      <a onclick="revealContent('block_<?php echo $block['id']; ?>');" class="cursor_pointer">
        <div class="box_small_long_content bg_vlight_bdr_pool">
          <div class="text_reveal_button"><span class="material-symbols-outlined margin_right_b">deployed_code</span><div>Block: <b><?php echo privacyFilter($block['hash'], 21); ?></b></div></div>
          <div class="text_heavy text_right reveal_button">
            &nbsp;
            <span class="material-symbols-outlined">unfold_more</span>
          </div>
          <?php debugData($block['hash'], $page_configuration['debug_mode']); ?>
        </div>
      </a>
      <div id="block_<?php echo $block['id']; ?>" class="hidden">
        <div class="list_wrap gap_small">
          <div class="columns_two gap_small">
            <div class="box_small bg_light">
              <div>Submitted</div>
              <div class="text_heavy text_right"><?php echo formatDateTime($block['submitted']); ?></div>
              <?php debugData($block['submitted'], $page_configuration['debug_mode']); ?>
            </div>
            <div class="box_small bg_dark">
              <div>Confirmed</div>
              <div class="text_heavy text_right"><?php echo formatDateTime($block['timestamp']); ?></div>
              <?php debugData($block['timestamp'], $page_configuration['debug_mode']); ?>
            </div>
          </div>
          <div class="columns_three gap_small">
            <div class="box_small bg_light">
              <div>Height</div>
              <div class="text_heavy text_right"><?php echo $block['height']; ?></div>
              <?php debugData($block['height'], $page_configuration['debug_mode']); ?>
            </div>
            <div class="box_small bg_light">
              <div>Difficulty</div>
              <div class="text_heavy text_right">
                <?php echo formatLargeNumbers($block['difficulty'], $pool_configuration['math_precision']); ?>
              </div>
              <?php debugData($block['difficulty'], $page_configuration['debug_mode']); ?>
            </div>
            <div class="box_small bg_dark">
              <div>Luck</div>
              <div class="text_heavy text_right">
                <?php echo formatPercents($block['luck'], $pool_configuration['math_precision']); ?>
              </div>
              <?php debugData($block['luck'], $page_configuration['debug_mode']); ?>
            </div>
          </div>
          <div class="wrap bg_vlight">
            <div class="list_wrap gap_small">
              <div class="box_small_long_content bg_light">
                <div>Winner</div>
                <div class="text_heavy text_right">
                  <?php echo privacyFilter($block['miner']).'.'.getWorkerName($block['worker']); ?>
                </div>
                <?php debugData($block['worker'], $page_configuration['debug_mode']); ?>
              </div>
              <div class="box_small_long_content bg_light">
                <div>Transaction</div>
                <div class="text_heavy text_right"><?php echo privacyFilter($block['transaction'], 21); ?></div>
                <?php debugData($block['transaction'], $page_configuration['debug_mode']); ?>
              </div>
            </div>
          </div>
          <div class="wrap bg_vlight">
            <div class="list_wrap gap_small">
              <a onclick="revealContent('<?php echo $block['round']; ?>');" class="cursor_pointer">
                <div class="box_small_long_content bg_vlight_bdr_dark">
                  <div class="text_reveal_button"><span class="material-symbols-outlined margin_right_b">cached</span>Round</div>
                  <div class="text_heavy text_right reveal_button">
                    <?php echo $block['round']; ?>
                    <span class="material-symbols-outlined">unfold_more</span>
                  </div>
                </div>
              </a>
              <div id="<?php echo $block['round']; ?>" class="hidden">
                <div class="list_wrap gap_small">
                  <?php
                  $count = 0;
                  foreach ($rounds_combined as $round) {
                    if ($round['round'] == $block['round']) {
                      if ($count > 0) { ?>
                        <hr class="hr_inner hr_wrap hr_wlist">
                        <?php
                      }?>

                      <div class="list_wrap gap_small">
                        <div class="box_small_long_content bg_light">
                          <div>Worker</div>
                          <div class="text_heavy text_right">
                            <?php echo privacyFilter($round['miner']).'.'.getWorkerName($round['worker']); ?>
                          </div>
                          <?php debugData($round['worker'], $page_configuration['debug_mode']); ?>
                        </div>
                        <div class="columns_three gap_small">
                          <div class="box_small bg_dark">
                            <div>Valid shares</div>
                            <div class="text_heavy text_right">
                              <?php echo formatLargeNumbers($round['valid'], $pool_configuration['math_precision']); ?>
                            </div>
                            <?php debugData($round['valid'], $page_configuration['debug_mode']); ?>
                          </div>
                          <div class="box_small bg_light">
                            <div>Stale shares</div>
                            <div class="text_heavy text_right">
                              <?php echo formatLargeNumbers($round['stale'], $pool_configuration['math_precision']); ?>
                            </div>
                            <?php debugData($round['stale'], $page_configuration['debug_mode']); ?>
                          </div>
                          <div class="box_small bg_light">
                            <div>Invalid shares</div>
                            <div class="text_heavy text_right">
                              <?php echo formatLargeNumbers($round['invalid'], $pool_configuration['math_precision']); ?>
                            </div>
                            <?php debugData($round['invalid'], $page_configuration['debug_mode']); ?>
                          </div>
                        </div>
                      </div>
                        <?php
                      $count = $count + 1;
                    }
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
          <div class="columns_two gap_small">
            <div class="box_small bg_light">
              <div>Block type</div>
              <div class="text_heavy text_right"><?php echo ($block['solo'] ? 'SOLO' : 'SHARED'); ?></div>
              <?php debugData($block['solo'] ? 'true' : 'false', $page_configuration['debug_mode']); ?>
            </div>
            <div class="box_small bg_pool">
              <div>Reward</div>
              <div class="text_heavy text_right">
                <?php echo formatLargeNumbers($block['reward'], $pool_configuration['math_precision']).$server_configuration['symbol']; ?>
              </div>
              <?php debugData($block['reward'], $page_configuration['debug_mode']); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php if ($block != end($blocks_combined)) { ?>
      <hr class="hr_inner hr_list">
      <?php
    }
  } ?>
</div>
