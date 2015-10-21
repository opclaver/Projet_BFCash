<fieldset>
	<h4>Informations about payment</h4>

	<div class="row">
		<label for="paymentAmount">Payment amount</label>
		<input type="text" name="paymentAmount" id="paymentAmount" value="<?php  if(isset($_GET['amount'])) echo $_GET['amount']; else echo 1000; ?>">
	</div>

	<div class="row">
		<label for="paymentMode">Payment mode</label>
		<select	name="paymentMode" id="paymentMode">
			<option value="CPT" <?php if(in_array($displayedPage, array('fullWebPayment','doAuthorization','doImmediateWalletPayment','doScheduledWalletPayment')) && strcmp ("CPT",PAYMENT_MODE) == 0) echo "selected"; ?>>CPT (Comptant)</option>
			<option value="DIF" <?php if(in_array($displayedPage, array('fullWebPayment','doAuthorization','doImmediateWalletPayment','doScheduledWalletPayment')) && strcmp ("DIF",PAYMENT_MODE) == 0) echo "selected"; ?>>DIF (Diff&#233;r&#233;)</option>
			<option value="NX" <?php if(in_array($displayedPage, array('fullWebPayment','doScheduledWalletPayment')) && strcmp ("NX",PAYMENT_MODE) == 0) echo "selected"; ?>>NX (N fois)</option>
			<option value="REC" <?php if((in_array($displayedPage, array('fullWebPayment')) && strcmp ("REC",PAYMENT_MODE) == 0) ||  $displayedPage == 'doRecurrentWalletPayment') echo "selected"; ?>>REC (R&#233;current)</option>
		</select>
	</div>

	<div class="row">
		<label for="paymentAction">Payment action</label>
    <select name="paymentAction" id="paymentAction">
			<option value="100" <?php if(in_array($displayedPage, array('fullWebPayment','doAuthorization','doImmediateWalletPayment','doScheduledWalletPayment','doRecurrentWalletPayment')) && strcmp ("100",PAYMENT_ACTION) == 0) echo "selected"; ?>>100 (Autorisation)</option>
			<option value="101" <?php if(in_array($displayedPage, array('fullWebPayment','doAuthorization','doImmediateWalletPayment','doScheduledWalletPayment','doRecurrentWalletPayment')) && strcmp ("101",PAYMENT_ACTION) == 0) echo "selected"; ?>>101 (Autorisation+Validation)</option>
			<option value="110" <?php if(in_array($displayedPage, array('fullWebPayment','doAuthorization')) && strcmp ("110",PAYMENT_ACTION) == 0) echo "selected"; ?>>110 (Autorisation REC - enregistrement CVV)</option>
			<option value="111" <?php if(in_array($displayedPage, array('fullWebPayment','doAuthorization')) && strcmp ("111",PAYMENT_ACTION) == 0) echo "selected"; ?>>111 (Autorisation+Validation REC - enregistrement CVV)</option>
			<option value="120" <?php if(in_array($displayedPage, array('fullWebPayment','doAuthorization')) && strcmp ("120",PAYMENT_ACTION) == 0) echo "selected"; ?>>120 (Autorisation sans CVV)</option>
			<option value="121" <?php if(in_array($displayedPage, array('fullWebPayment','doAuthorization')) && strcmp ("121",PAYMENT_ACTION) == 0) echo "selected"; ?>>121 (Autorisation+Validation sans CVV)</option>
			<option value="201" <?php if($displayedPage == 'doCapture') echo "selected"; ?>>201 (Validation)</option>
			<option value="202" <?php if($displayedPage == 'doCapture' && strcmp ("202",PAYMENT_ACTION) == 0) echo "selected"; ?>>202 (R&#233;autorisation)</option>
			<option value="204" <?php if($displayedPage == 'doDebit') echo "selected"; ?>>204 (D&#233;bit)</option>
			<option value="421" <?php if($displayedPage == 'doRefund') echo "selected"; ?>>421 (Remboursement)</option>
			<option value="422" <?php if($displayedPage == 'doCredit') echo "selected"; ?>>422 (Recr&#233;dit)</option>			
		</select>
	</div>

	<div class="row">
		<label for="paymentCurrency">Payment currency</label>
		<input type="text" name="paymentCurrency" id="paymentCurrency" value="<?php  if(isset($_GET['currency'])) echo $_GET['currency']; else echo PAYMENT_CURRENCY; ?>">
	</div>

	<div class="row">
		<label for="paymentContractNumber">Contract number</label>
		<input type="text" name="paymentContractNumber" id="paymentContractNumber" value="<?php  if(isset($_GET['contractNumber'])) echo $_GET['contractNumber']; else echo CONTRACT_NUMBER; ?>">
	</div>

	<div class="row">
		<label for="differedActionDate">Differed action date</label>
		<input type="text" name="differedActionDate" id="differedActionDate" value="">
		<span class="help">(format : "dd/mm/yy")</span>
	</div>

</fieldset>