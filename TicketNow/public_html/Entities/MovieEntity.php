<? php

class MovieEntity {
        public $ID;
        public $Name;
        public $Description;
        public $Date;
        public $Language;
        public $Rating;
        public $Image;

        function __construct($ID, $Name, $Description, $Date; $Language, $Rating, $Image) {
                $this->ID = $ID ;
                $this->Name = $Name;
                $this->Description = $Description;
                $this->Date = $Date;
                $this->Language = $Language;
                $this->Rating = $Rating;
                $this->Image = $Image;
        }
}

?>
