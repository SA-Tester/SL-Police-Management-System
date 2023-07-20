<?php

namespace Complaints;

interface Complaints{
    public function saveAudio();
    public function convertCategory($category);
    public function addComplaint($type);
    public function updateComplaint();
}