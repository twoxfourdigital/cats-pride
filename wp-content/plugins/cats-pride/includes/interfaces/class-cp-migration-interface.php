<?php

interface CP_Migration_Interface {

    public function run();

    public function rollback();

}