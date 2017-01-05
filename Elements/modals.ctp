<!-- Modal (connexion ...) -->
<div class="modal modal-medium fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $Lang->get('GLOBAL__CLOSE') ?></span></button>
        <h4 class="modal-title" id="myModalLabel"><?= $Lang->get('USER__LOGIN') ?></h4>
      </div>
      <form id="login-before-two-factor-auth" class="form-horizontal" method="POST" data-ajax="true" action="<?= $this->Html->url(array('plugin' => null, 'admin' => false, 'controller' => 'user', 'action' => 'ajax_login')) ?>" data-callback-function="afterLogin">
        <div class="modal-body">
          <div class="ajax-msg"></div>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label"><?= $Lang->get('USER__USERNAME') ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="pseudo" id="inputEmail3" placeholder="<?= $Lang->get('USER__USERNAME_LABEL') ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?= $Lang->get('USER__PASSWORD') ?></label>
            <div class="col-sm-10">
              <input type="password" class="form-control" name="password" placeholder="<?= $Lang->get('USER__PASSWORD_LABEL') ?>">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
  						<label class="checkbox nomargin" style="padding-top:0;"><input class="checked-agree" type="checkbox" name="remember_me"><i></i>
                <?= $Lang->get('USER__REMEMBER_ME') ?>
              </label>
            </div>
					</div>

          <center><a data-dismiss="modal" href="#" data-toggle="modal" data-target="#lostpasswd"><?= $Lang->get('USER__PASSWORD_FORGOT_LABEL') ?></a></center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?= $Lang->get('GLOBAL__CLOSE') ?></button>
          <button type="submit" class="btn btn-primary"><?= $Lang->get('USER__LOGIN') ?></button>
        </div>
      </form>
      <form id="login-two-factor-auth" style="display:none;" class="form-horizontal" method="POST" data-ajax="true" action="<?= $this->Html->url(array('plugin' => 'TwoFactorAuth', 'admin' => false, 'controller' => 'user', 'action' => 'validLogin')) ?>" data-redirect-url="?">
        <div class="modal-body">
          <div class="ajax-msg"></div>
          <input type="checkbox" style="display: none;" name="remember_me">

          <div class="form-group text-center">
            <label><?= $Lang->get('TWOFACTORAUTH__LOGIN_CODE') ?></label>
            <div class="col-md-6" style="margin: 0 auto;float: none;">
              <input type="text" class="form-control" name="code" placeholder="<?= $Lang->get('TWOFACTORAUTH__LOGIN_CODE_PLACEHOLDER') ?>">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?= $Lang->get('GLOBAL__CLOSE') ?></button>
          <button type="submit" class="btn btn-primary"><?= $Lang->get('USER__LOGIN') ?></button>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  function afterLogin(req, res) {
    if (res['two-factor-auth'] === undefined) // no two factor auth
      return window.location = '?t_' + Date.now()
    // remember_me
    $('#login-two-factor-auth input[name="remember_me"]').attr('checked', $('#login-before-two-factor-auth input[name="remember_me"]').is(':checked'))
    // display code form
    $('#login-before-two-factor-auth').slideUp(150)
    $('#login-two-factor-auth').slideDown(150)
  }
</script>

<div class="modal modal-medium fade" id="lostpasswd" tabindex="-1" role="dialog" aria-labelledby="lostpasswdLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $Lang->get('GLOBAL__CLOSE') ?></span></button>
        <h4 class="modal-title" id="myModalLabel"><?= $Lang->get('USER__PASSWORD_FORGOT_LABEL') ?></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" data-ajax="true" action="<?= $this->Html->url(array('plugin' => null, 'admin' => false, 'controller' => 'user', 'action' => 'ajax_lostpasswd')) ?>">
          <div class="form-group">
            <label class="col-sm-2 control-label"><?= $Lang->get('USER__EMAIL') ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="email" placeholder="<?= $Lang->get('USER__EMAIL_LABEL') ?>">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?= $Lang->get('GLOBAL__CLOSE') ?></button>
        <button type="submit" class="btn btn-primary"><?= $Lang->get('USER__PASSWORD_FORGOT_SEND_MAIL') ?></button>
      </form>
      </div>
    </div>
  </div>
</div>

<?php if(!empty($resetpsswd)) { ?>
  <div class="modal modal-medium fade" id="lostpasswd2" tabindex="-1" role="dialog" aria-labelledby="lostpasswd2Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?= $Lang->get('GLOBAL__CLOSE') ?></span></button>
          <h4 class="modal-title" id="myModalLabel"><?= $Lang->get('USER__PASSWORD_FORGOT_LABEL') ?></h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="POST" data-ajax="true" action="<?= $this->Html->url(array('plugin' => null, 'admin' => false, 'controller' => 'user', 'action' => 'ajax_resetpasswd')) ?>" data-redirect-url="?">
            <input type="hidden" name="key" value="<?= $resetpsswd['key'] ?>">
            <input type="hidden" name="email" value="<?= $resetpsswd['email'] ?>">
            <div class="form-group">
              <label  class="col-sm-2 control-label"><?= $Lang->get('USER__PASSWORD') ?></label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="password" placeholder="<?= $Lang->get('USER__PASSWORD_LABEL') ?>">
              </div>
            </div>
            <div class="form-group">
              <label  class="col-sm-2 control-label"><?= $Lang->get('USER__PASSWORD_CONFIRM') ?></label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="password2" placeholder="<?= $Lang->get('USER__PASSWORD_CONFIRM_LABEL') ?>">
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?= $Lang->get('GLOBAL__CLOSE') ?></button>
          <button type="submit" class="btn btn-success"><?= $Lang->get('GLOBAL__SAVE') ?></button>
        </form>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<script type="text/javascript">
  $(document).ready(function(){
    <?php if(!empty($resetpsswd)) { ?>
      $('#lostpasswd2').modal('show');
    <?php } ?>
  });
</script>
