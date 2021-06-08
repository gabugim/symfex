<?php


namespace App\Service;

use App\Entity\Program;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;


class Mailer
{
    private $mailer;
    private $parameterBag;
    private$twig;
    /**
     * Mailer constructor.
     * @param $mailer
     */
    public function __construct(MailerInterface $mailer, ParameterBagInterface $parameterBag, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->parameterBag = $parameterBag;
        $this->twig = $twig;
    }


    public function sendEmail($program, string $template): void
    {
        $email = (new Email())
            ->from($this->parameterBag->get('mailer_from'))
            ->to('gabu-g@hotmail.fr')
            ->subject('Time for Symfony Mailer!')
            ->html($this->twig->render($template, ['program' => $program]));
        $this->mailer->send($email);
    }

}