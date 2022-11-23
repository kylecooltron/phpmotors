
INSERT INTO clients 
    (clients.clientFirstname,
     clients.clientLastname,
     clients.clientEmail,
     clients.clientPassword,
     clients.comment)
 VALUES
     ("Tony",
      "Stark",
      "tony@starkent.com",
      "Iam1ronM@n",
      "I am the real Ironman");

UPDATE clients
SET clients.clientLevel = 3
WHERE clients.clientFirstname = 'Tony' AND clients.clientLastname = 'Stark';

UPDATE inventory
SET inventory.invDescription = REPLACE(inventory.invDescription, 'small interior', 'spacious interior')
WHERE inventory.invModel = 'Hummer';

SELECT 
    carclassification.classificationName,
    inventory.invModel
    FROM carclassification
    JOIN inventory ON carclassification.classificationId = inventory.classificationId
    WHERE carclassification.classificationName = 'SUV';


DELETE FROM inventory WHERE inventory.invModel = 'Wrangler';


UPDATE inventory
SET inventory.invImage = CONCAT('/phpmotors', inventory.invImage),
inventory.invThumbnail = CONCAT('/phpmotors', inventory.invThumbnail);

