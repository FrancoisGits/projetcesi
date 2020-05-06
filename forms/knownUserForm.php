<form class="formGroup" action="../actions/mailAction.php" method="post">
    <div class="disclaimer">
        <h1 class="disclaimerTitle">¯\_(シ)_/¯ Oups ! Vous semblez avoir déjà rempli ce formulaire !</h1>
        <p class="disclaimerBody">Si ce n'est pas le cas ou que vous souhaitez modifier vos informations, merci de
            remplir le formulaire ci-dessous pour nous contacter.</p>
    </div>
    <div id="selectInputGroup" class="formInputGroup">
        <label for="subject">Objet:</label>
        <div class="select">
            <select name="subject" required id="subject">
                <option value="dataNotSubmitted">Je n'ai pas encore rempli le formulaire</option>
                <option value="datamodification">Je souhaite modifier mes informations</option>
            </select>
        </div>
    </div>
    <div class="formInputGroup">
        <label id="messageLabel" for="message">Message:</label>
        <textarea
                placeholder="Votre Message"
                name="message"
                id="message"
                class="formInput formError"
                spellcheck="true"
                required
                maxlength="255"
                title="maximum 255 caractères"
        ></textarea>
    </div>
    <span>* Champs requis</span>
    <button type="submit">Valider</button>
</form>