<?php

namespace Orbitali\Foundations;

use Clockwork\Support\Laravel\Console\CapturingFormatter as ClockworkCapturingFormatter;

class CapturingFormatter extends ClockworkCapturingFormatter
{
	public function format(?string $message): ?string
	{
		$formatted = $this->formatter->format($message);

		$this->capturedOutput .= PHP_EOL.trim($formatted);

		return $formatted;
	}

    public function capturedOutput()
	{
		$capturedOutput = trim($this->capturedOutput);

		$this->capturedOutput = null;

		return $capturedOutput;
	}
}
