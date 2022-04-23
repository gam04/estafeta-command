<?php

namespace Gam\Estafeta\Command\Model;

class Label
{
    private string $id;

    private string $message;

    private string $pdf;

    /**
     * @param string $id
     * @param string $message
     * @param string $pdf
     */
    public function __construct(string $id, string $message, string $pdf)
    {
        $this->id = $id;
        $this->message = $message;
        $this->pdf = $pdf;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getPdf(): string
    {
        return $this->pdf;
    }
}
