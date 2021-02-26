<?php


class InputValidator
{

    private $parenthesis = [
        '(' => ')',
        '[' => ']',
        '{' => '}',
    ];

    /**
     * @param string $input
     * @throws InputValidationException
     */
    private function checkCharacters(string $input):void
    {
        preg_match("#^[\[\]\(\)\{\}]+$#",$input,$matches);

        if (empty($matches)) {
            throw new InputValidationException("Hatalı Parametre");
        }

    }

    /**
     * @param string $input
     * @throws InputValidationException
     */
    private function checkParenthesisClosing(string $input){
        $success = true;
        $totalUnClosedParenthesis = 0;
        foreach ($this->parenthesis as $open => $close) {
            $openCount = substr_count($input,$open);
            $closeCount = substr_count($input,$close);

            if ($openCount != $closeCount) {
                $success = false;
                $unClosedParenthesis = $openCount - $closeCount;
                $totalUnClosedParenthesis += $unClosedParenthesis > 0 ? $unClosedParenthesis : 0;
                if ($totalUnClosedParenthesis > 10) {
                    throw new InputValidationException("Çok Fazla Kapanmamış Parantez Var");
                }
            }
        }

        if (!$success) {
            throw new InputValidationException("Başarısız");
        }
    }

    /**
     * @param string $input
     * @throws InputValidationException
     */
    private function checkBalanceOfParenthesis(string $input){
        preg_match_all("#[\[\{\(]#",$input,$openings);
        preg_match_all("#[\]\}\)]#",$input,$closings);
        $openings = $openings[0];
        $closings = array_reverse($closings[0]);
        foreach ($openings as $index => $perOpening) {

            if ($this->parenthesis[$perOpening] !== $closings[$index]) {
                throw new InputValidationException("Başarısız");
            }
        }

    }


    public function validateInput(string $input): string
    {
        try {
            $this->checkCharacters($input);
            $this->checkParenthesisClosing($input);
            $this->checkBalanceOfParenthesis($input);
        } catch (InputValidationException $e) {
            return $e->getMessage();
        }

        return "Başarılı";
    }
}