<?php

    class TemplateAttributeCollection {
        public $HasDecorators = false;
        public $HasBodyProvidingDecorators = false;
        public $HasAttributeModifyingDecorators = false;
        public $HasConditionalDecorators = false;

        public $Attributes = [];
        public $Decorators = [];
        public $FunctionParameters = [];
    }

?>