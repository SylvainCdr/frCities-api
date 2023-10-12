<?php

namespace App\DataFixtures;

use App\Entity\City;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
                //CSV
                $csv = "src/DataFixtures/cities.csv";

                // On ouvre le fichier csv en lecture
                $csvToRead = fopen($csv, 'r');

                // On met le csv dans un tableau $csvArray
                while (! feof($csvToRead) ) {
                    $csvArray[] = fgetcsv($csvToRead, 100, ';');
                }
                $countArray = count($csvArray);
                // dd($csvArray);
                $j=0; //compteur pour flush
                //On boucle sur $csvArray pour récupérer chaque élément
                //On fait commencer $i à 1 pour éviter la ligne d'entêtes contenus à l'index 0 de csvArray
                
                for ($i = 1; $i < $countArray - 2; $i++) {
                    $j++;
                    $city = new City();
                    $city->setZip($csvArray[$i][0]) //Code Postal
                    ->setName($csvArray[$i][1]) //Ville
                    ->setLat($csvArray[$i][2]) //Latitude
                    ->setLon($csvArray[$i][3]) //Longitude
                    ;
        
                    // On persiste l'objet $zip
                    $manager->persist($city);
                }

        $manager->flush();
    }
}
