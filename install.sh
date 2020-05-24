#!/bin/bash

# Permettre aux fichiers nécessitant des autorisations de lire, écrire et executer
chmod 777 php/createdata.php
chmod 777 php/generation.php
chmod 777 php/generationcsv.php
chmod 777 php/generationsql.php

echo 'php files enabled'

chmod 777 userfile

echo 'userfile enabled'