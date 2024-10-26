<?php

abstract class Car {
    public $name;
    public $speed;
    public $distance =0;

public function __construct($name, $speed) {
    $this->name = $name;
    $this->speed = $speed;
}

abstract public function drive();

public function getDistance() {
    return $this->distance;
}

public function getName() {
    return $this->name;
}

}

class SportsCar extends Car {
    public function drive (){
        $this->distance += $this->speed * 1.2;
    }
}

class SUV extends Car {
    public function drive () {
        $this->distance += $this->speed *1.0;
    }
}

class Truck extends Car {
    public function drive () {
        $this->distance += $this->speed *0.8;
    }
}

class Race {
    private $cars = [];
    private $distance;

    public function __construct($distance) {
        $this->distance = $distance;
    }

    public function addCar (Car $car) {
        $this->cars[] = $car;
    }

    public function start() {
        echo "the race has started! \n\n";
        $finished = false;

        while (!$finished) {
            foreach ($this->cars as $car) {
                $car->drive();
                if ($car->getDistance() >= $this->distance) {
                    $finished = true;
                    break;
                }
            }
        }
        $this->displayResults();
    }

    public function displayResults () {
        usort($this->cars, function ($a, $b) {
            return $b->getDistance() - $a->getDistance();
        });

        echo "Race Results:\n";
        foreach ($this->cars as $index => $car){
            echo ($index + 1) . "." . $car->getName() . "Distance: " . $car->getDistance() . "meters\n";
        } 
    }
}

$race = new Race(1000);

$race->addCar(new SportsCar("Ferrari", 200));
$race->addCar(new SUV("Range Rover", 150));
$race->addCar(new Truck("Volvo Truck", 100));

$race->start();

?>