<?php
/**
 * Template Name: Wizard
 *
 * @package lsx
 */

get_header(); ?>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php lsx_content_wrap_before(); ?>

<div id="primary" class="content-area <?php echo esc_attr( lsx_main_class() ); ?>">

	<?php lsx_content_before(); ?>

	<main id="main" class="site-main" role="main">

		<?php lsx_content_top(); ?>

		<?php if ( have_posts() ) : ?>

			<?php
			while ( have_posts() ) :
				the_post();
			?>

				<?php get_template_part( 'partials/content', 'page' ); ?>
        <div class="row">
          <div id="wizard" class="wizard">
    <div class="wizard__content">
      <header class="wizard__header">


        <div class="wizard__steps">
          <nav class="steps">
          <div class="step">
            <div class="step__content">
              <p class="step__number"><i class="fa fa-github-alt"></i></p>
              <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
              </svg>

              <div class="lines">
                <div class="line -start">
                </div>

                <div class="line -background">
                </div>

                <div class="line -progress">
                </div>
              </div>
            </div>
          </div>

          <div class="step">
            <div class="step__content">
              <p class="step__number"><i class="fa fa-book"></i></p>
              <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
              </svg>

              <div class="lines">
                <div class="line -background">
                </div>

                <div class="line -progress">
                </div>
              </div>
            </div>
          </div>

          <div class="step">
            <div class="step__content">
              <p class="step__number"><i class="fa fa-group"></i></p>
              <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
              </svg>

              <div class="lines">
                <div class="line -background">
                </div>

                <div class="line -progress">
                </div>
              </div>
            </div>
          </div>
        </nav>
        </div>
      </header>


      <div class="panels">
        <div class="panel">
            <header class="panel__header">
              <h2 class="panel__title">Create a Github account</h2>
              <p class="panel__subheading">With github you can show your projects and find new things everyday!</p>
            </header>

           <p class="panel__content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna culpa qui officia deserunt mollit anim id est laborum.</p>

          <p class="panel__content">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>

        <div class="panel">
           <header class="panel__header">
              <h2 class="panel__title">Learn more about pure Javascript.</h2>
              <p class="panel__subheading">We have cool frameworks, but none is better then VanillaJS</p>
           </header>

           <p class="panel__content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna culpa qui officia deserunt mollit anim id est laborum.</p>
           <p class="panel__content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>

        <div class="panel">
          <header class="panel__header">
            <h2 class="panel__title">Stay in touch with the community.</h2>
            <p class="panel__subheading">Community is everything, and here we do some crazy stuff.</p>
           </header>

          <p class="panel__content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </div>

      <div class="wizard__footer">
      <button class="button previous">Previous</button>
      <button class="button next">Next</button>
    </div>
    </div>

    <h1 class="wizard__congrats-message">
      Congratulations, you are now in a world of pain and suffering!
    </h1>
  </div>
</div>
        </div>


			<?php endwhile; ?>

		<?php endif; ?>

		<?php lsx_content_bottom(); ?>

	</main><!-- #main -->

	<?php lsx_content_after(); ?>

	<?php
	if ( comments_open() ) {
		comments_template();
	}
	?>

</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php get_sidebar(); ?>
<script type="text/javascript">
class Steps{
  constructor(wizard){
    this.wizard = wizard;
    this.steps = this.getSteps();
    this.stepsQuantity = this.getStepsQuantity();
    this.currentStep = 0;
  }

  setCurrentStep(currentStep){
    this.currentStep = currentStep;
  }

  getSteps(){
    return this.wizard.getElementsByClassName('step');
  }

  getStepsQuantity(){
    return this.getSteps().length;
  }

  handleConcludeStep(){
    this.steps[this.currentStep].classList.add('-completed');
  }

  handleStepsClasses(movement){
    if(movement > 0)
      this.steps[this.currentStep - 1].classList.add('-completed');
    else if(movement < 0)
      this.steps[this.currentStep].classList.remove('-completed');
  }
}

class Panels{
  constructor(wizard){
    this.wizard = wizard;
    this.panelWidth = this.wizard.offsetWidth;
    this.panelsContainer = this.getPanelsContainer();
    this.panels = this.getPanels();
    this.currentStep = 0;

    this.updatePanelsPosition(this.currentStep);
    this.updatePanelsContainerHeight();
  }

  getCurrentPanelHeight(){
    return `${this.getPanels()[this.currentStep].offsetHeight}px`;
  }

  getPanelsContainer(){
    return this.wizard.querySelector('.panels');
  }

  getPanels(){
    return this.wizard.getElementsByClassName('panel');
  }

  updatePanelsContainerHeight(){
    this.panelsContainer.style.height = this.getCurrentPanelHeight();
  }

  updatePanelsPosition(currentStep){
    const panels = this.panels;
    const panelWidth = this.panelWidth;

    for (let i = 0; i < panels.length; i++) {
      panels[i].classList.remove(
         'movingIn',
         'movingOutBackward',
         'movingOutFoward'
      );

      if(i !== currentStep){
        if(i < currentStep) panels[i].classList.add('movingOutBackward');
        else if( i > currentStep ) panels[i].classList.add('movingOutFoward');
      }else{
        panels[i].classList.add('movingIn');
      }
    }

    this.updatePanelsContainerHeight();
  }

  setCurrentStep(currentStep){
    this.currentStep = currentStep;
    this.updatePanelsPosition(currentStep);
  }
}

class Wizard{
  constructor(obj){
    this.wizard = obj;
    this.panels = new Panels(this.wizard);
    this.steps = new Steps(this.wizard);
    this.stepsQuantity = this.steps.getStepsQuantity();
    this.currentStep = this.steps.currentStep;

    this.concludeControlMoveStepMethod = this.steps.handleConcludeStep.bind(this.steps);
    this.wizardConclusionMethod = this.handleWizardConclusion.bind(this);
  }

  updateButtonsStatus(){
    if(this.currentStep === 0)
      this.previousControl.classList.add('disabled');
    else
      this.previousControl.classList.remove('disabled');
  }

  updtadeCurrentStep(movement){
    this.currentStep += movement;
    this.steps.setCurrentStep(this.currentStep);
    this.panels.setCurrentStep(this.currentStep);

    this.handleNextStepButton();
    this.updateButtonsStatus();
  }

  handleNextStepButton(){
    if(this.currentStep === this.stepsQuantity - 1){
      this.nextControl.innerHTML = 'Conclude!';

      this.nextControl.removeEventListener('click', this.nextControlMoveStepMethod);
      this.nextControl.addEventListener('click', this.concludeControlMoveStepMethod);
      this.nextControl.addEventListener('click', this.wizardConclusionMethod);
    }else{
      this.nextControl.innerHTML = 'Next';

      this.nextControl.addEventListener('click', this.nextControlMoveStepMethod);
      this.nextControl.removeEventListener('click', this.concludeControlMoveStepMethod);
      this.nextControl.removeEventListener('click', this.wizardConclusionMethod);
    }
  }

  handleWizardConclusion(){
    this.wizard.classList.add('completed');
  };

  addControls(previousControl, nextControl){
    this.previousControl = previousControl;
    this.nextControl = nextControl;
    this.previousControlMoveStepMethod = this.moveStep.bind(this, -1);
    this.nextControlMoveStepMethod = this.moveStep.bind(this, 1);

    previousControl.addEventListener('click', this.previousControlMoveStepMethod);
    nextControl.addEventListener('click', this.nextControlMoveStepMethod);

    this.updateButtonsStatus();
  }

  moveStep(movement){
    if(this.validateMovement(movement)){
      this.updtadeCurrentStep(movement);
      this.steps.handleStepsClasses(movement);
    }else{
       throw('This was an invalid movement');
    }
  }

  validateMovement(movement){
    const fowardMov = movement > 0 && this.currentStep < this.stepsQuantity - 1;
    const backMov = movement < 0 && this.currentStep > 0;

    return fowardMov || backMov;
  }
}

let wizardElement = document.getElementById('wizard');
let wizard = new Wizard(wizardElement);
let buttonNext = document.querySelector('.next');
let buttonPrevious = document.querySelector('.previous');

wizard.addControls(buttonPrevious, buttonNext);

</script>

<?php
get_footer();
