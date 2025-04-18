const guess_the_name_of_the_bunny = [
    ["Fiona", "Nick Watt"],
    ["Ringo", "Chris Williams"],
    ["Punch", "Adrian Mitchison"],
    ["Muggsy", "Adrian Mitchison"],
    ["Haree", "Michael McElduff"],
    ["Elfie", "Ellie Robson-Grice"],
    ["Zora", "Andrew Heppell"],
    ["Humphrey", "Elena Swales"],
    ["Evie", "Colin Haggie"],
    ["Felton", "Colin Haggie"],
    ["Bugsy", "Emma Ashman"],
    ["Freddie", "Christina Mancini"],
    ["Hammer", "Andrew Griffiths"],
    ["Dobbs", "Joanne Holmes"],
    ["Cindy", "Joanne Holmes"],
    ["Angellica", "Nicole Sullivan"],
    ["Bun", "Anne-Marie Thomas"],
    ["Haystack", "Jo Wraith"],
    ["Lucy", "Carly Krasner"],
    ["Frolic", "Carly Krasner"],
    ["Bubba", "Christina Mancini"],
    ["Thunder", "Laura Greenhill"],
    ["Brownie", "Laura Greenhill"],
    ["Annie", "Christina Mancini"],
    ["Dopey", "Christina Mancini"],
    ["Blue", "Christina Mancini"],
    ["Ruby", "Christina Mancini"],
    ["Roosevelt", "Joseph Ashman"],
    ["Jax", "Alastair Johnson"],
    ["Amber", "Vineeta O'Kay"],
    ["Jive", "Samanta Moat"],
    ["Besty", "Julia Das"],
    ["Floppy", "Julia Das"],
    ["Playboy", "Leonie Earnshaw"],
    ["Twitch", "David Hallewell"],
    ["Midnight", "David Hallewell"],
    ["Oreo", "Vicki Anderson"],
    ["Roger", "Vicki Anderson"],
    ["Fabio", "Vicki Anderson"],
    ["Hopper", "Vicki Anderson"],
    ["Clumsy", "Kevin Spreadbury"],
    ["Ares", "Georgie Wilkins"],
    ["Stompy", "Jen Patterson"],
    ["Snuggle", "Jen Patterson"],
    ["Bugs", "Jen Patterson"],
    ["Snowball", "Sarah Williams"],
    ["Farah", "Sarah Williams"],
    ["Bucky", "Chris Williams"],
    ["Harvey", "Helen Watson"],
    ["Bunro", "Helen Watson"],
    ["Bobbin", "Ailie Hodgson"],
    ["Binky", "Ailie Hodgson"],
    ["Hazel", "Julie Gent"],
    ["Benny", "Elaine Allan"],
    ["Ash", "Marcello Dell'edera"],
    ["Bella", "Helen Watson"],
    ["Tarquin", "Shiully Goffar"],
    ["Flopsy", "Michala Smith"],
    ["Houdini", "Michala Smith"],
    ["Peter", "Michala Smith"],
    ["Dapper", "Michala Smith"],
    ["Babbity", "Irene Ewart"],
    ["Daisy", "Joanne Bunn"],
    ["Coco", "Joanna Bunn"],
    ["Buffy", "Elaine McKechnie"],
    ["Scamper", "Rebecca McElwee"],
    ["Jupiter", "Neil Ramsay"],
    ["Bouncer", "Neil Ramsay"],
    ["Hopkins", "Seema Vadhera"],
    ["Popcorn", "Seema Vadhera"],
    ["Bunny", "Russell Hall"],
    ["Cinnabun", "Russell Hall"],
    ["Lola", "Victoria Wright"],
    ["Sage", "Michelle Anderson"],
    ["Holly", "Holly Co"],
    ["Babs", "Sarah Mulholland"],
    ["Harry", "Harry Brown"],
    ["Gypsy", "Jack Hickson"],
    ["Frank", "Vicki Anderson"],
    ["Chopper", "Hannah McManus"],
    ["Aspen", "Christina Mancini"],
    ["Red", "Christina Mancini"],
    ["Energizer", "Christina Mancini"],
    ["Misty", "Steve Boddy"],
    ["Xavier", "Joseph Ashman"],
    ["Thumper", "Nick Watt"],
    ["Artemis", "Emma Ashman"],
    ["Basil", "Susan Ashman"],
    ["Oswald", "Anne-Marie Thomas"],
    ["Candy", "Helen Watson"],
    ["Spice", "Helen Watson"],
    ["Marshy", "Silvia Moffatt"],
    ["Coral", "Kerrie Hutchinson"] 
];

function ghac_guess_the_name_of_the_bunny() {
    var stage1 = document.getElementById('bunny_stage_1');
    var stage2 = document.getElementById('bunny_stage_2');
    var stage3 = document.getElementById('bunny_stage_3');

    var randomIndex = Math.floor(Math.random() * (guess_the_name_of_the_bunny.length - 1 + 1)) + 1;
    bunnyname = guess_the_name_of_the_bunny[randomIndex - 1];
    document.getElementById('bunny_name').innerText = bunnyname[0];
    document.getElementById('bunny_winner').innerText = bunnyname[1];

    stage1.className = 'd-none';
    stage2.className = '';

    //window.setInterval(ghac_guess_the_name_of_the_bunny_winner, 1000);
    setTimeout(() => { 
        stage2.className = 'd-none';
        stage3.className = '';
    }, 5000);
}

function ghac_guess_the_name_of_the_bunny_winner() {
    
}