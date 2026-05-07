<?php

/**
 * @class Musique
 * @brief Classe permettant de gérer les musiques
 * 
 * Cette classe permet de consulter, rechercher, ajouter, supprimer et initialiser des chansons dans la base de données
 */
class Musique {

    /**
     * @var PDO $pdo
     * @brief Instance de connexion à la base de données
     */
    private $pdo;

    /**
     * @brief Constructeur de la classe Musique
     * 
     * @param PDO $pdo Instance de connexion PDO
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * @brief Récupère toutes les chansons
     * 
     * @return array Liste complète des chansons
     */
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM CHANSON");
        return $stmt->fetchAll();
    }

    /**
     * @brief Recherche des chansons par titre
     * 
     * @param string $titre Titre ou partie du titre recherché
     * 
     * @return array Liste des chansons correspondantes
     */
    public function search($titre) {
        $sql = "SELECT * FROM CHANSON WHERE titre LIKE :titre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'titre' => '%' . $titre . '%'
        ]);
        return $stmt->fetchAll();
    }

    /**
     * @brief Ajoute une nouvelle chanson
     * 
     * @param string $titre Titre de la chanson
     * @param string $artiste Nom de l'artiste
     * @param int $annee Année de sortie
     * @param string $genre Genre musical
     * @param string $fichier Lien ou chemin du fichier audio
     * 
     * @return bool Retourne true si l'ajout réussit, sinon false
     */
    public function insert($titre, $artiste, $annee, $genre, $fichier) {
        $sql = "INSERT INTO CHANSON (titre, artiste, annee, genre, fichier)
                VALUES (:titre, :artiste, :annee, :genre, :fichier)";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'titre' => $titre,
            'artiste' => $artiste,
            'annee' => $annee,
            'genre' => $genre,
            'fichier' => $fichier
        ]);
    }

    /**
     * @brief Insère un ensemble de musiques prédéfinies
     * 
     * Ajoute les chansons uniquement si leur titre n'existe pas déjà
     * 
     * @return void
     */
    public function addBigSeed() {

        $musiques = [
                ['Black Summer','Red Hot Chili Peppers',2022,'Rock','https://www.youtube.com/watch?v=OS8taasZl8k&list=RDOS8taasZl8k&start_radio=1'],
                ['Here Ever After','Red Hot Chili Peppers',2022,'Rock','https://www.youtube.com/watch?v=mjFG4U2dSUE&list=RDmjFG4U2dSUE&start_radio=1'],
                ['Aquatic Mouth Dance','Red Hot Chili Peppers',2022,'Rock','https://www.youtube.com/watch?v=MIABpVRDb-I&list=RDMIABpVRDb-I&start_radio=1'],
                ['Not The One','Red Hot Chili Peppers',2022,'Rock','https://www.youtube.com/watch?v=5EuWBWxHs18&list=RD5EuWBWxHs18&start_radio=1'],
                ['Poster Child','Red Hot Chili Peppers',2022,'Rock','https://www.youtube.com/watch?v=lxHWfCzS5uQ&list=RDlxHWfCzS5uQ&start_radio=1'],
                ['The Great Apes','Red Hot Chili Peppers',2022,'Rock','https://www.youtube.com/watch?v=ElI-G3QY3J0&list=RDElI-G3QY3J0&start_radio=1'],
                ['It\'s Only Natural','Red Hot Chili Peppers',2022,'Rock','https://www.youtube.com/watch?v=ArYw6-6qKwM&list=RDArYw6-6qKwM&start_radio=1'],
                ['She\'s A Lover','Red Hot Chili Peppers',2022,'Rock','https://www.youtube.com/watch?v=E5HLF92vf9U&list=RDE5HLF92vf9U&start_radio=1'],
                ['These Are The Ways','Red Hot Chili Peppers',2022,'Rock','https://www.youtube.com/watch?v=PccS-4wSZCY&list=RDPccS-4wSZCY&start_radio=1'],
                ['Whatchu Thinkin\'','Red Hot Chili Peppers',2022,'Rock','https://www.youtube.com/watch?v=4jW2sIGimqU&list=RD4jW2sIGimqU&start_radio=1'],
                ['Bastards Of Light','Red Hot Chili Peppers',2022,'Rock','https://www.youtube.com/watch?v=IrtyWkRU2TM&list=RDIrtyWkRU2TM&start_radio=1'],
                ['White Braids & Pillow Chair','Red Hot Chili Peppers',2022,'Rock','https://www.youtube.com/watch?v=g81F_2UfXzQ&list=RDg81F_2UfXzQ&start_radio=1'],
                ['One Way Traffic','Red Hot Chili Peppers',2022,'Rock','https://www.youtube.com/watch?v=zXNy-Osk1ek&list=RDzXNy-Osk1ek&start_radio=1'],
                ['Veronica','Red Hot Chili Peppers',2022,'Rock','https://www.youtube.com/watch?v=t1TG63eDcfY&list=RDt1TG63eDcfY&start_radio=1'],
                ['Let \'Em Cry','Red Hot Chili Peppers',2022,'Rock','https://www.youtube.com/watch?v=mtswRrd-V_U&list=RDmtswRrd-V_U&start_radio=1'],
                ['The Heavy Wing','Red Hot Chili Peppers',2022,'Rock','https://www.youtube.com/watch?v=VzRYRi2cb4g'],
                ['Tangelo','Red Hot Chili Peppers',2022,'Rock','https://www.youtube.com/watch?v=ZL1pd0ebh_E&list=RDZL1pd0ebh_E&start_radio=1'],
                ['Around The World','Red Hot Chili Peppers',1999,'Rock','https://www.youtube.com/watch?v=a9eNQZbjpJk&list=RDa9eNQZbjpJk&start_radio=1'],
                ['Californication','Red Hot Chili Peppers',1999,'Rock','https://www.youtube.com/watch?v=YlUKcNNmywk'],
                ['Scar Tissue','Red Hot Chili Peppers',1999,'Rock','https://www.youtube.com/watch?v=mzJj5-lubeM'],
                ['Otherside','Red Hot Chili Peppers',1999,'Rock','https://www.youtube.com/watch?v=rn_YodiJO6k'],
                ['Parallel Universe','Red Hot Chili Peppers',1999,'Rock','https://www.youtube.com/watch?v=X-o8eGhKhlI'],
                ['Heavydirtysoul','Twenty One Pilots',2015,'Alternative','https://www.youtube.com/watch?v=r_9Kf0D5BTs'],
                ['Stressed Out','Twenty One Pilots',2015,'Alternative','https://www.youtube.com/watch?v=pXRviuL6vMY'],
                ['Ride','Twenty One Pilots',2015,'Alternative','https://www.youtube.com/watch?v=Pw-0pbY9JeU'],
                ['Fairly Local','Twenty One Pilots',2015,'Alternative','https://www.youtube.com/watch?v=HDI9inno86U'],
                ['Tear In My Heart','Twenty One Pilots',2015,'Alternative','https://www.youtube.com/watch?v=nky4me4NP70'],
                ['Lane Boy','Twenty One Pilots',2015,'Alternative','https://www.youtube.com/watch?v=ywvRgGAd2XI'],
                ['The Judge','Twenty One Pilots',2015,'Alternative','https://www.youtube.com/watch?v=PbP-aIe51Ek'],
                ['Doubt','Twenty One Pilots',2015,'Alternative','https://www.youtube.com/watch?v=MEiVnNNpJLA'],
                ['Polarize','Twenty One Pilots',2015,'Alternative','https://www.youtube.com/watch?v=MiPBQJq49xk'],
                ['We Don\'t Believe What\'s On TV','Twenty One Pilots',2015,'Alternative','https://www.youtube.com/watch?v=zZEumf7RowI'],
                ['Message Man','Twenty One Pilots',2015,'Alternative','https://www.youtube.com/watch?v=iE_54CU7Fxk'],
                ['Hometown','Twenty One Pilots',2015,'Alternative','https://www.youtube.com/watch?v=pJtlLzsDICo'],
                ['Not Today','Twenty One Pilots',2015,'Alternative','https://www.youtube.com/watch?v=yqem6k_3pZ8'],
                ['Goner','Twenty One Pilots',2015,'Alternative','https://www.youtube.com/watch?v=3J5mE-J1WLk'],
                ['Take A Bow','Muse',2006,'Rock','https://www.youtube.com/watch?v=_v8zDNNaWak'],
                ['Starlight','Muse',2006,'Rock','https://www.youtube.com/watch?v=Pgum6OT_VH8'],
                ['Supermassive Black Hole','Muse',2006,'Rock','https://www.youtube.com/watch?v=Xsp3_a-PMTw'],
                ['Map Of The Problematique','Muse',2006,'Rock','https://www.youtube.com/watch?v=Nw5AMCEiZms'],
                ['Knights Of Cydonia','Muse',2006,'Rock','https://www.youtube.com/watch?v=G_sBOsh-vyI'],
                ['Invincible','Muse',2006,'Rock','https://www.youtube.com/watch?v=D_5V8We3hgg'],
                ['Assassin','Muse',2006,'Rock','https://www.youtube.com/watch?v=nNPSSs1xnpY'],
                ['Uprising','Muse',2009,'Rock','https://www.youtube.com/watch?v=w8KQmps-Sog'],
                ['Resistance','Muse',2009,'Rock','https://www.youtube.com/watch?v=TPE9uSFFxrI'],
                ['Undisclosed Desires','Muse',2009,'Rock','https://www.youtube.com/watch?v=R8OOWcsFj0U'],
                ['Unnatural Selection','Muse',2009,'Rock','https://www.youtube.com/watch?v=T23AY5gYhpE'],
                ['Foreword','Linkin Park',2003,'Nu Metal','https://www.youtube.com/watch?v=oWfGOVWrueo'],
                ['Don\'t Stay','Linkin Park',2003,'Nu Metal','https://www.youtube.com/watch?v=qq1UEeS1a7c'],
                ['Somewhere I Belong','Linkin Park',2003,'Nu Metal','https://www.youtube.com/watch?v=zsCD5XCu6CM'],
                ['Lying From You','Linkin Park',2003,'Nu Metal','https://www.youtube.com/watch?v=NjdgcHdzvac'],
                ['Hit The Floor','Linkin Park',2003,'Nu Metal','https://www.youtube.com/watch?v=oMals9XXQY8'],
                ['Easier To Run','Linkin Park',2003,'Nu Metal','https://www.youtube.com/watch?v=U5zdmjVeQzE'],
                ['Faint','Linkin Park',2003,'Nu Metal','https://www.youtube.com/watch?v=LYU-8IFcDPw'],
                ['Figure.09','Linkin Park',2003,'Nu Metal','https://www.youtube.com/watch?v=LpC0SKU6O00'],
                ['Breaking The Habit','Linkin Park',2003,'Nu Metal','https://www.youtube.com/watch?v=v2H4l9RpkwM'],
                ['From The Inside','Linkin Park',2003,'Nu Metal','https://www.youtube.com/watch?v=YLHpvjrFpe0'],
                ['Nobody\'s Listening','Linkin Park',2003,'Nu Metal','https://www.youtube.com/watch?v=QJ87793QXes'],
                ['Session','Linkin Park',2003,'Nu Metal','https://www.youtube.com/watch?v=J1KqQYsUYIk'],
                ['Numb','Linkin Park',2003,'Nu Metal','https://www.youtube.com/watch?v=kXYiU_JCYtU'],
                ['Papercut','Linkin Park',2000,'Nu Metal','https://www.youtube.com/watch?v=vjVkXlxsO8Q'],
                ['One Step Closer','Linkin Park',2000,'Nu Metal','https://www.youtube.com/watch?v=4qlCC1GOwFw'],
                ['With You','Linkin Park',2000,'Nu Metal','https://www.youtube.com/watch?v=M8UTS2iFXOo'],
                ['Points Of Authority','Linkin Park',2000,'Nu Metal','https://www.youtube.com/watch?v=yoCD5wZEgo4'],
                ['Crawling','Linkin Park',2000,'Nu Metal','https://www.youtube.com/watch?v=Gd9OhYroLN0'],
                ['In The End','Linkin Park',2000,'Nu Metal','https://www.youtube.com/watch?v=eVTXPUF4Oz4'],
                ['A Place For My Head','Linkin Park',2000,'Nu Metal','https://www.youtube.com/watch?v=3t2WkCudwfY'],
                ['En apesanteur','Calogero',2002,'Pop Rock','https://www.youtube.com/watch?v=jasIqn8IifQ'],
                ['Si seulement je pouvais lui manquer','Calogero',2004,'Pop Rock','https://www.youtube.com/watch?v=fn0Jx6S2TR4'],
                ['Face à la mer','Calogero',2004,'Pop Rock','https://www.youtube.com/watch?v=MFhKnRLEihE'],
                ['Pomme C','Calogero',2007,'Pop Rock','https://www.youtube.com/watch?v=hscImB4KgXE'],
                ['1987','Calogero',2017,'Pop Rock','https://www.youtube.com/watch?v=EOEvzbub4wk'],
                ['Un jour au mauvais endroit','Calogero',2014,'Pop Rock','https://www.youtube.com/watch?v=W0xjW-e4KEg'],
                ['Je joue de la musique','Calogero',2017,'Pop Rock','https://www.youtube.com/watch?v=SPK9fxvvbfk'],
                ['Du Hast','Rammstein',1997,'Metal','https://www.youtube.com/watch?v=W3q8Od5qJio'],
                ['Engel','Rammstein',1997,'Metal','https://www.youtube.com/watch?v=hNwMfgHcz5k'],
                ['Sonne','Rammstein',2001,'Metal','https://www.youtube.com/watch?v=v7GMG1aLyPw'],
                ['Ich Will','Rammstein',2001,'Metal','https://www.youtube.com/watch?v=EOnSh3QlpbQ'],
                ['Feuer Frei!','Rammstein',2002,'Metal','https://www.youtube.com/watch?v=ZkW-K5RQdzo'],
                ['Amerika','Rammstein',2004,'Metal','https://www.youtube.com/watch?v=Rr8ljRgcJNM'],
                ['Mein Teil','Rammstein',2004,'Metal','https://www.youtube.com/watch?v=PBvwcH4XX6U'],
                ['Deutschland','Rammstein',2019,'Metal','https://www.youtube.com/watch?v=NeQM1c-XCDc'],
                ['Radio','Rammstein',2019,'Metal','https://www.youtube.com/watch?v=z0NfI2NeDHI'],
                ['Zeit','Rammstein',2022,'Metal','https://www.youtube.com/watch?v=EbHGS_bVkXY'],
                ['Je te donne','Jean-Jacques Goldman',1985,'Variété','https://www.youtube.com/watch?v=493R05ifNsI'],
                ['Quand la musique est bonne','Jean-Jacques Goldman',1982,'Variété','https://www.youtube.com/watch?v=-boDeijWuOY'],
                ['L\'Aventurier','Indochine',1982,'Rock','https://www.youtube.com/watch?v=M7X6oYg6iro'],
                ['3e sexe','Indochine',1985,'Rock','https://www.youtube.com/watch?v=SWtiCRntA-E'],
                ['J\'ai demandé à la lune','Indochine',2002,'Rock','https://www.youtube.com/watch?v=KAOmC5qT02w'],
                ['Papaoutai','Stromae',2013,'Pop','https://www.youtube.com/watch?v=oiKj0Z_Xnjc'],
                ['Formidable','Stromae',2013,'Pop','https://www.youtube.com/watch?v=S_xH7noaqTA'],
                ['Tous les mêmes','Stromae',2013,'Pop','https://www.youtube.com/watch?v=CAMWdvo71ls'],
                ['Dernière danse','Indila',2013,'Pop','https://www.youtube.com/watch?v=K5KAc5CoCuk'],
                ['Tourner dans le vide','Indila',2014,'Pop','https://www.youtube.com/watch?v=vtNJMAyeP0s'],
                ['Allumer le feu','Johnny Hallyday',1998,'Rock','https://www.youtube.com/watch?v=s3O1Xro7oAI'],
                ['Que je t\'aime','Johnny Hallyday',1969,'Rock','https://www.youtube.com/watch?v=V_o05vQEpQE'],
                ['The Emptiness Machine','Linkin Park',2024,'Nu Metal','https://www.youtube.com/watch?v=SRXH9AbT280'],
                ['Heavy Is The Crown','Linkin Park',2024,'Nu Metal','https://www.youtube.com/watch?v=5FrhtahQiRc'],
                ['Over Each Other','Linkin Park',2024,'Nu Metal','https://www.youtube.com/watch?v=fSHoePrnmMw'],
                ['Friendly Fire','Linkin Park',2024,'Nu Metal','https://www.youtube.com/watch?v=HMluqSGag5E'],
                ['Lost','Linkin Park',2023,'Nu Metal','https://www.youtube.com/watch?v=7NK_JOkuSVY'],
                ['Shy Away','Twenty One Pilots',2021,'Alternative','https://www.youtube.com/watch?v=3sO-Y1Zbft4'],
                ['Saturday','Twenty One Pilots',2021,'Alternative','https://www.youtube.com/watch?v=FiXVRdotCEk'],
                ['Choker','Twenty One Pilots',2021,'Alternative','https://www.youtube.com/watch?v=2sBRnnnZyFw'],
                ['The Outside','Twenty One Pilots',2021,'Alternative','https://www.youtube.com/watch?v=eNcvblM8-_o'],
                ['Overcompensate','Twenty One Pilots',2024,'Alternative','https://www.youtube.com/watch?v=53tgVlXBZVg'],
                ['Next Semester','Twenty One Pilots',2024,'Alternative','https://www.youtube.com/watch?v=a5i-KdUQ47o'],
                ['Backslide','Twenty One Pilots',2024,'Alternative','https://www.youtube.com/watch?v=YAmLMohrus4'],
                ['Hysteria','Muse',2003,'Rock','https://www.youtube.com/watch?v=3dm_5qWWDV8'],
                ['Time Is Running Out','Muse',2003,'Rock','https://www.youtube.com/watch?v=O2IuJPh6h_A'],
                ['Plug In Baby','Muse',2001,'Rock','https://www.youtube.com/watch?v=dbB-mICjkQM'],
                ['Madness','Muse',2012,'Rock','https://www.youtube.com/watch?v=SOJSM46nWwo'],
                ['Psycho','Muse',2015,'Rock','https://www.youtube.com/watch?v=UqLRqzTp6Rk'],
                ['Kill Or Be Killed','Muse',2022,'Rock','https://www.youtube.com/watch?v=GgyQufB1Yic'],
                ['Can\'t Stop','Red Hot Chili Peppers',2002,'Rock','https://www.youtube.com/watch?v=8DyziWtkfBw'],
                ['Dani California','Red Hot Chili Peppers',2006,'Rock','https://www.youtube.com/watch?v=Sb5aq5HcS1A'],
                ['Snow (Hey Oh)','Red Hot Chili Peppers',2006,'Rock','https://www.youtube.com/watch?v=p0vM9iINl28'],
                ['By The Way','Red Hot Chili Peppers',2002,'Rock','https://www.youtube.com/watch?v=JnfyjwChuNU'],
                ['Under The Bridge','Red Hot Chili Peppers',1991,'Rock','https://www.youtube.com/watch?v=GLvohMXgcBo'],
                ['Give It Away','Red Hot Chili Peppers',1991,'Rock','https://www.youtube.com/watch?v=Mr_uHJPUlO8'],
                ['Dark Necessities','Red Hot Chili Peppers',2016,'Rock','https://www.youtube.com/watch?v=Q0oIoR9mLwc'],
                ['Chop Suey!','System Of A Down',2001,'Metal','https://www.youtube.com/watch?v=CSvFpBOe8eY'],
                ['Toxicity','System Of A Down',2001,'Metal','https://www.youtube.com/watch?v=iywaBOMvYLI'],
                ['B.Y.O.B.','System Of A Down',2005,'Metal','https://www.youtube.com/watch?v=zUzd9KyIDrM'],
                ['Aerials','System Of A Down',2001,'Metal','https://www.youtube.com/watch?v=L-iepu3EtyE'],
                ['American Idiot','Green Day',2004,'Rock','https://www.youtube.com/watch?v=Ee_uujKuJMI'],
                ['Boulevard Of Broken Dreams','Green Day',2004,'Rock','https://www.youtube.com/watch?v=Soa3gO7tL-c'],
                ['Holiday','Green Day',2004,'Rock','https://www.youtube.com/watch?v=Ajxn0PKbv7I'],
                ['The Pretender','Foo Fighters',2007,'Rock','https://www.youtube.com/watch?v=SBjQ9tuuTJQ'],
                ['Everlong','Foo Fighters',1997,'Rock','https://www.youtube.com/watch?v=hq0rZ3IiyWw'],
                ['Smells Like Teen Spirit','Nirvana',1991,'Rock','https://www.youtube.com/watch?v=hTWKbfoikeg'],
                ['Come As You Are','Nirvana',1992,'Rock','https://www.youtube.com/watch?v=vabnZ9-ex7o'],
                ['Lithium','Nirvana',1992,'Rock','https://www.youtube.com/watch?v=pkcJEvMcnEg'],
                ['In Bloom','Nirvana',1992,'Rock','https://www.youtube.com/watch?v=PbgKEjNBHqM'],
                ['Heart-Shaped Box','Nirvana',1993,'Rock','https://www.youtube.com/watch?v=n6P0SitRwy8'],
                ['All Apologies','Nirvana',1993,'Rock','https://www.youtube.com/watch?v=aWmkuH1k7uA'],
                ['About A Girl','Nirvana',1989,'Rock','https://www.youtube.com/watch?v=JIx2H-plXdU'],
                ['Breed','Nirvana',1991,'Rock','https://www.youtube.com/watch?v=J6EDW5WFb2M'],
                ['Rape Me','Nirvana',1993,'Rock','https://www.youtube.com/watch?v=3rS6mZUo3fg'],
                ['The Man Who Sold The World','Nirvana',1994,'Rock','https://www.youtube.com/watch?v=fregObNcHC8'],
                ['Enter Sandman','Metallica',1991,'Metal','https://www.youtube.com/watch?v=CD-E-LDc384'],
                ['Nothing Else Matters','Metallica',1991,'Metal','https://www.youtube.com/watch?v=tAGnKpE4NCI'],
                ['Duality','Slipknot',2004,'Metal','https://www.youtube.com/watch?v=6fVE8kSM43I'],
                ['Psychosocial','Slipknot',2008,'Metal','https://www.youtube.com/watch?v=5abamRO41fE'],
                ['Dernière danse','Kyo',2003,'Rock','https://www.youtube.com/watch?v=aU_TQcyGkvY'],
                ['Le chemin','Kyo',2003,'Rock','https://www.youtube.com/watch?v=CLuOd8xMRRo'],
                ['Le vent nous portera','Noir Désir',2001,'Rock','https://www.youtube.com/watch?v=NrgcRvBJYBE'],
                ['Throne','Bring Me The Horizon',2015,'Rock','https://www.youtube.com/watch?v=Ow_qI_F2ZJI'],
                ['Get Lucky (Radio Edit - feat. Pharrell Williams and Nile Rodgers)','Daft Punk','2016','Electro','https://www.youtube.com/watch?v=Rgrt_8mXrK8'],
                ['One More Time (Radio Edit)','Daft Punk','2017','Electro','https://www.youtube.com/watch?v=wU26xVT_vBU'],
                ['Instant Crush (feat. Julian Casablancas)','Daft Punk','2015','Electro','https://www.youtube.com/watch?v=khnokW3Mw24'],
                ['Around the World','Daft Punk','2017','Electro','https://www.youtube.com/watch?v=Jb6gcoR266U'],
                ['Harder Better Faster Stronger','Daft Punk','2014','Electro','https://www.youtube.com/watch?v=JhulBGMA7G4'],
                ['Veridis Quo','Daft Punk','2017','Electro','https://www.youtube.com/watch?v=qe8Q7mjxjig'],
                ['Lose Yourself to Dance (feat. Pharrell Williams)','Daft Punk','2015','Electro','https://www.youtube.com/watch?v=iU7oF4OXZSE'],
                ['Something About Us','Daft Punk','2017','Electro','https://www.youtube.com/watch?v=URzOGF_QGls'],
                ['Giorgio by Moroder','Daft Punk','2014','Electro','https://www.youtube.com/watch?v=ZFZM6jDTWd4'],
                ['End of Line (From TRON: Legacy / Score)','Daft Punk','2019','Electro','https://www.youtube.com/watch?v=NOMa56y_Was'],
                ['Voyager','Daft Punk','2014','Electro','https://www.youtube.com/watch?v=OWiVJMgms9E'],
                ['Digital Love','Daft Punk','2014','Electro','https://www.youtube.com/watch?v=Smi8vAbm_8o'],
                ['Face to Face','Daft Punk','2014','Electro','https://www.youtube.com/watch?v=qXI87eMP-bs'],
                ['Robot Rock','Daft Punk','2014','Electro','https://www.youtube.com/watch?v=l4L78W66kCI'],
                ['Give Life Back to Music','Daft Punk','2015','Electro','https://www.youtube.com/watch?v=zKSsP2084nU'],
                ['Aerodynamic','Daft Punk','2014','Electro','https://www.youtube.com/watch?v=52fNscjkST4'],
                ['Technologic','Daft Punk','2015','Electro','https://www.youtube.com/watch?v=4qlDWL1kMcQ'],
                ['Da Funk','Daft Punk','2015','Electro','https://www.youtube.com/watch?v=32J7bZHva9M'],
                ['Yellow','Coldplay','2015','Rock','https://www.youtube.com/watch?v=9qnqYL0eNNI'],
                ['Viva La Vida','Coldplay','2024','Rock','https://www.youtube.com/watch?v=ALsvdSA9tOU'],
                ['The Scientist','Coldplay','2015','Rock','https://www.youtube.com/watch?v=gm-Y9idMMQ4'],
                ['A Sky Full of Stars','Coldplay','2017','Rock','https://www.youtube.com/watch?v=KWuyx6yZ21U'],
                ['Sparks','Coldplay','2015','Rock','https://www.youtube.com/watch?v=1aokooixKIo'],
                ['Adventure of a Lifetime','Coldplay','2018','Rock','https://www.youtube.com/watch?v=XsMpXczOIPs'],
                ['Paradise','Coldplay','2015','Rock','https://www.youtube.com/watch?v=Q0TEUMPIhk8'],
                ['Hymn for the Weekend','Coldplay','2018','Rock','https://www.youtube.com/watch?v=H3Kzh6RrnMc'],
                ['Clocks','Coldplay','2015','Rock','https://www.youtube.com/watch?v=8Xv_Hg8o1fw'],
                ['Fix You','Coldplay','2015','Rock','https://www.youtube.com/watch?v=Oncu0bgdcXU'],
                ['My Universe','Coldplay','2021','Rock','https://www.youtube.com/watch?v=TaZkqPK0sbw'],
                ['WE PRAY','Coldplay','2024','Rock','https://www.youtube.com/watch?v=BrIa2CFIW30'],
                ['Idol','YOASOBI','2023','J-Pop','https://www.youtube.com/watch?v=m9SMT5ipbxk'],
                ['Yoru ni Kakeru','YOASOBI','2021','J-Pop','https://www.youtube.com/watch?v=mJ1N7-HyH1A'],
                ['Kaibutsu','YOASOBI','2021','J-Pop','https://www.youtube.com/watch?v=k0g04t7ZeSw'],
                ['Yuusha','YOASOBI','2023','J-Pop','https://www.youtube.com/watch?v=M4-XU0a2hf0'],
                ['UNDEAD','YOASOBI','2024','J-Pop','https://www.youtube.com/watch?v=BryspbM6s3E'],
                ['Shukufuku','YOASOBI','2022','J-Pop','https://www.youtube.com/watch?v=2eNEQ0cQtkI'],
                ['Gunjo','YOASOBI','2021','J-Pop','https://www.youtube.com/watch?v=dGZqpVCJP3k'],
                ['Tabun','YOASOBI','2021','J-Pop','https://www.youtube.com/watch?v=rgNdeflYdYw'],
                ['Ano Yume o Nazotte','YOASOBI','2021','J-Pop','https://www.youtube.com/watch?v=9NPv4q57on8'],
                ['Haruka','YOASOBI','2021','J-Pop','https://www.youtube.com/watch?v=VoozNIvzEG8'],
                ['Watch me!','YOASOBI','2025','J-Pop','https://www.youtube.com/watch?v=ttfLNUIYXH0'],
                ['All The Stars','Kendrick Lamar','2018','Rap','https://www.youtube.com/watch?v=9jdLnFYQh4s'],
                ['Not Like Us','Kendrick Lamar','2024','Rap','https://www.youtube.com/watch?v=phLb_SoPBlA'],
                ['luther','Kendrick Lamar','2024','Rap','https://www.youtube.com/watch?v=XVveECQmiAk'],
                ['Money Trees','Kendrick Lamar','2018','Rap','https://www.youtube.com/watch?v=Iy-dJwHVX84'],
                ['HUMBLE.','Kendrick Lamar','2018','Rap','https://www.youtube.com/watch?v=H4RELGc9su8'],
                ['tv off','Kendrick Lamar','2024','Rap','https://www.youtube.com/watch?v=Rh3bJKkEhk8'],
                ['Swimming Pools (Drank)','Kendrick Lamar','2018','Rap','https://www.youtube.com/watch?v=T_OWvLDIyno'],
                ['Bitch Don\'t Kill My Vibe','Kendrick Lamar','2018','Rap','https://www.youtube.com/watch?v=hDgPW4kIdUI'],
                ['LOVE.','Kendrick Lamar','2018','Rap','https://www.youtube.com/watch?v=XKkV2j9DbIQ'],
                ['squabble up','Kendrick Lamar','2024','Rap','https://www.youtube.com/watch?v=U0KTVVMvcc4'],
                ['Mockingbird','Eminem','2018','Rap','https://www.youtube.com/watch?v=9kznlAwE-8o'],
                ['Love The Way You Lie','Eminem','2018','Rap','https://www.youtube.com/watch?v=RnkShwdXfyc'],
                ['Without Me','Eminem','2018','Rap','https://www.youtube.com/watch?v=tqxRidAWER8'],
                ['Lose Yourself','Eminem','2018','Rap','https://www.youtube.com/watch?v=4wOLVrGHiIU'],
                ['The Real Slim Shady','Eminem','2018','Rap','https://www.youtube.com/watch?v=r5MR7_INQwg'],
                ['Till I Collapse','Eminem','2018','Rap','https://www.youtube.com/watch?v=Obim8BYGnOE'],
                ['Superman','Eminem','2018','Rap','https://www.youtube.com/watch?v=K_8yRH2KPVo'],
                ['Not Afraid','Eminem','2018','Rap','https://www.youtube.com/watch?v=-grPV-Fae6I'],
                ['The Monster','Eminem','2018','Rap','https://www.youtube.com/watch?v=SQVkYgkMzhY'],
                ['Stan','Eminem','2018','Rap','https://www.youtube.com/watch?v=HIqQ0PfuPo8'],
                ['Rap God','Eminem','2018','Rap','https://www.youtube.com/watch?v=MBJFPq2Llps'],
                ['Sing For The Moment','Eminem','2018','Rap','https://www.youtube.com/watch?v=MJNGXnvHYPg'],
                ['Shake That Ass','Eminem','2014','Rap','https://www.youtube.com/watch?v=kkQXY41S0fQ'],
                ['No Love','Eminem','2018','Rap','https://www.youtube.com/watch?v=i4CaamMGj9s'],
                ['NINAO','GIMS','2025','Pop','https://www.youtube.com/watch?v=KJtOTXqaW9w'],
                ['PARISIENNE','GIMS','2025','Pop','https://www.youtube.com/watch?v=ERk4Lx-mOqQ'],
                ['Est-ce que tu m\'aimes ? (Pilule bleue)','GIMS','2017','Pop','https://www.youtube.com/watch?v=ErFyeO-MppU'],
                ['SPIDER','GIMS','2024','Pop','https://www.youtube.com/watch?v=su8lPj0PFKI'],
                ['SOIS PAS TIMIDE','GIMS','2024','Pop','https://www.youtube.com/watch?v=-46M0YWMszs'],
                ['SPA','GIMS','2026','Pop','https://www.youtube.com/watch?v=Zm9RJff5fjw'],
                ['Hola Señorita','GIMS','2019','Pop','https://www.youtube.com/watch?v=siDZfw3eDyo'],
                ['SEYA','GIMS','2023','Pop','https://www.youtube.com/watch?v=nd2Axc66GCE'],
                ['CIEL','GIMS','2024','Pop','https://www.youtube.com/watch?v=cj3Q_8L-QA8'],
                ['Bella','GIMS','2016','Pop','https://www.youtube.com/watch?v=vHAhA658hDw'],
                ['Sapés comme jamais (Pilule bleue)','GIMS','2015','Pop','https://www.youtube.com/watch?v=4jjSVjmV23M'],
                ['Corazón','GIMS','2020','Pop','https://www.youtube.com/watch?v=4TjwUrtHpQA'],
                ['deja vu','Olivia Rodrigo','2021','Pop','https://www.youtube.com/watch?v=pHw5jgsE_pY'],
                ['traitor','Olivia Rodrigo','2021','Pop','https://www.youtube.com/watch?v=4QLvEIXlF6Q'],
                ['drivers license','Olivia Rodrigo','2021','Pop','https://www.youtube.com/watch?v=l0txe6yk8Kc'],
                ['happier','Olivia Rodrigo','2021','Pop','https://www.youtube.com/watch?v=GBFWUR8XttQ'],
                ['good 4 u','Olivia Rodrigo','2021','Pop','https://www.youtube.com/watch?v=Bc9ijogGmtU'],
                ['jealousy, jealousy','Olivia Rodrigo','2021','Pop','https://www.youtube.com/watch?v=15RuCIbXE8A'],
                ['Can\'t Catch Me Now (from The Hunger Games: The Ballad of Songbirds & Snakes)','Olivia Rodrigo','2023','Pop','https://www.youtube.com/watch?v=QXjA-ahmi1A'],
                ['Lilac','Mrs. GREEN APPLE','2024','J-Pop','https://www.youtube.com/watch?v=DO_aopUeFnw'],
                ['Inferno','Mrs. GREEN APPLE','2019','J-Pop','https://www.youtube.com/watch?v=4u4muFfkbJQ'],
                ['Wind and Town','Mrs. GREEN APPLE','2026','J-Pop','https://www.youtube.com/watch?v=gY3dDWCUiaQ'],
                ['KUSUSHIKI','Mrs. GREEN APPLE','2025','J-Pop','https://www.youtube.com/watch?v=0Po9x1n0aQE'],
                ['Darling','Mrs. GREEN APPLE','2025','J-Pop','https://www.youtube.com/watch?v=PDoH2YnPg5U'],
                ['Soranji','Mrs. GREEN APPLE','2022','J-Pop','https://www.youtube.com/watch?v=7Ze7MDQjXS0'],
                ['Que Sera Sera','Mrs. GREEN APPLE','2023','J-Pop','https://www.youtube.com/watch?v=s4ZThuWQdhA'],
                ['Ao To Natsu','Mrs. GREEN APPLE','2018','J-Pop','https://www.youtube.com/watch?v=-QxMzUEJH4Q'],
                ['Bokuno Koto','Mrs. GREEN APPLE','2019','J-Pop','https://www.youtube.com/watch?v=gd5-TdPJ3AQ'],
                ['Dance Hall','Mrs. GREEN APPLE','2022','J-Pop','https://www.youtube.com/watch?v=Kt451YtL-Vs'],
                ['Wake Me Up','Avicii','2021','Electro','https://www.youtube.com/watch?v=2NiyrtYegso'],
                ['Waiting For Love','Avicii','2018','Electro','https://www.youtube.com/watch?v=iR1sAex__VA'],
                ['The Nights','Avicii','2018','Electro','https://www.youtube.com/watch?v=W4C-NEWrnSQ'],
                ['Levels (Radio Edit)','Avicii','2018','Electro','https://www.youtube.com/watch?v=xAgv1mAyxr8'],
                ['Hey Brother','Avicii','2021','Electro','https://www.youtube.com/watch?v=OjpX8ILe2N4'],
                ['I Could Be The One (Avicii Vs. Nicky Romero) (Radio Edit)','Avicii','2018','Electro','https://www.youtube.com/watch?v=ppWbG03O_AU'],
                ['Without You','Avicii','2018','Electro','https://www.youtube.com/watch?v=As_4JTmHuW4'],
                ['Levels (Original Version)','Avicii','2018','Electro','https://www.youtube.com/watch?v=wDuoOapZ9Z0'],
                ['Addicted To You','Avicii','2021','Electro','https://www.youtube.com/watch?v=nYuVZPV4vTw'],
                ['You Make Me','Avicii','2021','Electro','https://www.youtube.com/watch?v=aD57DeQ7afE'],
                ['Through The Fire And Flames','Dragonforce','2023','Metal','https://www.youtube.com/watch?v=XkFz_hi2tWY'],
                ['Fury of the Storm','Dragonforce','2023','Metal','https://www.youtube.com/watch?v=jyf-v_nUcqo'],
                ['Heroes Of Our Time','Dragonforce','2023','Metal','https://www.youtube.com/watch?v=4u5Le989KsQ'],
                ['Soldiers Of The Wastelands','Dragonforce','2023','Metal','https://www.youtube.com/watch?v=dmXEZ8gHJR0'],
                ['Cry Thunder','Dragonforce','2015','Metal','https://www.youtube.com/watch?v=20vgg_WoTz4'],
                ['Operation Ground And Pound','Dragonforce','2023','Metal','https://www.youtube.com/watch?v=g2USM-iiw_M'],
                ['Valley of the Damned (Remastered 2009)','Dragonforce','2023','Metal','https://www.youtube.com/watch?v=7tsYxnFp8pU'],
                ['Highway to Oblivion','Dragonforce','2019','Metal','https://www.youtube.com/watch?v=ZhNRu0Si2aE'],
                ['My Heart Will Go On','Dragonforce','2019','Metal','https://www.youtube.com/watch?v=sB1tPzhO30A'],
                ['Levitating','Dua Lipa','2020','Pop','https://www.youtube.com/watch?v=OsfAnsMY21M'],
                ['New Rules','Dua Lipa','2017','Pop','https://www.youtube.com/watch?v=ZqYGW8uXL0I'],
                ['Break My Heart','Dua Lipa','2020','Pop','https://www.youtube.com/watch?v=NaaiI1y9QIo'],
                ['Houdini','Dua Lipa','2024','Pop','https://www.youtube.com/watch?v=cCfPDrRQp9k'],
                ['Don\'t Start Now','Dua Lipa','2019','Pop','https://www.youtube.com/watch?v=htg8v0g_4e4'],
                ['IDGAF','Dua Lipa','2017','Pop','https://www.youtube.com/watch?v=GRRU11cFNOQ'],
                ['Be the One','Dua Lipa','2017','Pop','https://www.youtube.com/watch?v=-3gkan9wSaQ'],
                ['BAILE INOLVIDABLE','Bad Bunny','2025','Trap','https://www.youtube.com/watch?v=JseJETvMtHY'],
                ['DtMF','Bad Bunny','2025','Trap','https://www.youtube.com/watch?v=TiebZllW8As'],
                ['EoO','Bad Bunny','2025','Trap','https://www.youtube.com/watch?v=JYekRpqL4O8'],
                ['NUEVAYoL','Bad Bunny','2025','Trap','https://www.youtube.com/watch?v=WdSGEvDGZAo'],
                ['Tití Me Preguntó','Bad Bunny','2022','Trap','https://www.youtube.com/watch?v=juRFjpB5Ppg'],
                ['Moscow Mule','Bad Bunny','2022','Trap','https://www.youtube.com/watch?v=NBghhjuMNKM'],
                ['MONACO','Bad Bunny','2023','Trap','https://www.youtube.com/watch?v=J-7knuczw2E'],
                ['KLOuFRENS','Bad Bunny','2025','Trap','https://www.youtube.com/watch?v=LgbYE3cIdhs'],
                ['VOY A LLeVARTE PA PR','Bad Bunny','2025','Trap','https://www.youtube.com/watch?v=uE_pyM3X-e0'],
                ['MIA','Bad Bunny','2021','Trap','https://www.youtube.com/watch?v=Pw_Zemf6Wjs'],
                ['Si Veo a Tu Mamá','Bad Bunny','2021','Trap','https://www.youtube.com/watch?v=KywzeIM45FA'],
                ['Yonaguni','Bad Bunny','2021','Trap','https://www.youtube.com/watch?v=4ANS5JbqEiI'],
                ['Paranoid (2012 - Remaster)','Black Sabbath','2015','Metal','https://www.youtube.com/watch?v=xpM59e6lyws'],
                ['Iron Man (2012 - Remaster)','Black Sabbath','2015','Metal','https://www.youtube.com/watch?v=Y68sopy2yBE'],
                ['War Pigs / Luke\'s Wall (2012 - Remaster)','Black Sabbath','2015','Metal','https://www.youtube.com/watch?v=dX7ZzJ6ehVM'],
                ['Wasp / Behind the Wall of Sleep / Bassically / N.I.B. (2014 Remaster)','Black Sabbath','2016','Metal','https://www.youtube.com/watch?v=LO-VoFJw6Y0'],
                ['Children of the Grave (2014 Remaster)','Black Sabbath','2017','Metal','https://www.youtube.com/watch?v=jN0h_x5qHgo'],
                ['Heaven and Hell (2008 Remaster)','Black Sabbath','2014','Metal','https://www.youtube.com/watch?v=1zby0XK63Wo'],
                ['War Pigs / Luke\'s Wall (2012 - Remaster)','Black Sabbath','2017','Metal','https://www.youtube.com/watch?v=I7oc8Wv4G6I'],
                ['Thunderstruck','AC/DC','2018','Rock','https://www.youtube.com/watch?v=lhg9bYNLvOg'],
                ['Back In Black','AC/DC','2018','Rock','https://www.youtube.com/watch?v=9vWNauaZAgg'],
                ['You Shook Me All Night Long','AC/DC','2018','Rock','https://www.youtube.com/watch?v=SP9t2Iq_zQ8'],
                ['Hells Bells','AC/DC','2018','Rock','https://www.youtube.com/watch?v=GL56LY6fE0E'],
                ['Shoot to Thrill','AC/DC','2018','Rock','https://www.youtube.com/watch?v=wLoWd2KyUro'],
                ['Who Made Who','AC/DC','2018','Rock','https://www.youtube.com/watch?v=wEupw9Ejmq8'],
                ['T.N.T.','AC/DC','2018','Rock','https://www.youtube.com/watch?v=NhsK5WExrnE'],
                ['Touch Too Much','AC/DC','2015','Rock','https://www.youtube.com/watch?v=GjCWmUt62YE'],
                ['Moneytalks','AC/DC','2018','Rock','https://www.youtube.com/watch?v=iaaRYZPu9dc'],
                ['Can You Feel My Heart','Bring Me The Horizon',2013,'Rock','https://www.youtube.com/watch?v=QJJYpsA5tv8'],
                ['Halloween Secret Party','Flying Nuggets',2022,'Metal','https://www.youtube.com/watch?v=pxlSSLFZeeo&list=OLAK5uy_mY3CHsNCsrYkHQaWNliMLltCDqHcEylQY&index=2'],
                ['Flying Nuggets','Flying Nuggets',2022,'Metal','https://www.youtube.com/watch?v=2y2HGgKYEkQ&list=OLAK5uy_mY3CHsNCsrYkHQaWNliMLltCDqHcEylQY&index=2'],
                ['Lost in Two Worlds','Flying Nuggets',2022,'Metal','https://www.youtube.com/watch?v=GSwEqwpChys&list=OLAK5uy_mY3CHsNCsrYkHQaWNliMLltCDqHcEylQY&index=3'],
                ['The Interstellar Funky Pirates Of The Sea II','Flying Nuggets',2022,'Metal','https://www.youtube.com/watch?v=TBB5vEeEdKs&list=OLAK5uy_mY3CHsNCsrYkHQaWNliMLltCDqHcEylQY&index=4'],
                ['Mega Disco Giga Disto','Flying Nuggets',2022,'Metal','https://www.youtube.com/watch?v=_N2XLteXBoY&list=OLAK5uy_mY3CHsNCsrYkHQaWNliMLltCDqHcEylQY&index=5'],
                ['Yoan The Savior Shark','Flying Nuggets',2022,'Metal','https://www.youtube.com/watch?v=FzwnqBg6Ut4&list=OLAK5uy_mY3CHsNCsrYkHQaWNliMLltCDqHcEylQY&index=6'],
                    
        ];
    
        foreach ($musiques as $m) {

            if (!$this->existeTitre($m[0])) {
                $this->insert($m[0], $m[1], $m[2], $m[3], $m[4]);
            }
    
        }
    }

    /**
     * @brief Vérifie si un titre existe déjà
     * 
     * @param string $titre Titre à vérifier
     * 
     * @return bool Retourne true si le titre existe, sinon false
     */
    public function existeTitre($titre) {
        $sql = "SELECT COUNT(*) FROM CHANSON WHERE titre = :titre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['titre' => $titre]);
        return $stmt->fetchColumn() > 0;
    }

    /**
     * @brief Supprime une chanson
     * 
     * @param int $id Identifiant de la chanson
     * 
     * @return bool Retourne true si la suppression réussit, sinon false
     */
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM CHANSON WHERE idC = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>