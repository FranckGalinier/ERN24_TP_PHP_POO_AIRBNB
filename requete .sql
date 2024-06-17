SELECT * FROM logement as l
INNER JOIN logement_type 
WHERE l.id =1 
INSERT INTO logement (type_logement_id) VALUES (1)

SELECT * FROM logement as l
INNER JOIN `user` as u ON l.`user_id` = u.`id`
WHERE u.`is_active` =1