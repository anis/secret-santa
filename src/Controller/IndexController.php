<?php
namespace Anis\SecretSanta\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Anis\SecretSanta\Form\Type\AttendeeType;

class IndexController
{
    public function formAction(Request $request, Application $app)
    {
        return $app['twig']->render('form.twig', array('form' => $this->buildForm($app)->createView()));
    }

    public function sendAction(Request $request, Application $app)
    {
        $form = $this->buildForm($app);
        $form->handleRequest($request);

        $attendees = $form->getData()['attendees'];
        shuffle($attendees);

        $attendees[] = clone $attendees[0];

        for ($i = 0, $lim = count($attendees); $i < $lim - 1; $i++) {
            echo $attendees[$i]->email, ' offre à ',$attendees[$i + 1]->email,'<br/>';
        }

        $message = \Swift_Message::newInstance()
            ->setSubject('Ceci est un test d\'envoi avec SwitftMailer')
            ->setFrom(array('noreply@anis-safine.fr'))
            ->setTo(array('anis@safine.me'))
            ->setBody('Coucou, ceci est un test ! :)');

        var_dump($app['mailer']->send($message, $failures));
        var_dump($failures);

        die('end');
        return $app->redirect('/');
    }

    protected function buildForm(Application $app)
    {
        return $app['form.factory']->createBuilder('form')
            ->add(
                'attendees',
                'collection',
                array(
                    'label' => ' ',
                    'type' => new AttendeeType(),
                    'allow_add' => true
                )
            )
            ->getForm();
    }

    protected function buildEmail()
    {
        // return 
    }
}
