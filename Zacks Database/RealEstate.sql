
drop table web_users;
drop table listing;
drop table property;
drop table buyer;
drop table seller;
drop table agent;
drop table person_estate;
drop table office;

create table web_users
    (username varchar(50),
    password varchar(50)
    );
    
select * from web_users;
delete from web_users where username='Company';
commit;

insert into web_users
values ('buyer', 'pwd');
insert into web_users
values ('agent', 'pwd');
insert into web_users
values ('company', 'pwd');
insert into web_users
values ('customer', 'pwd');

create table office
    (office_id int not null,
    name varchar(50),
    street_address varchar(50),
    city varchar (20),
    state varchar (2),
    zip NUMERIC(5,0),
    email varchar (30),
    primary key (office_id)
    );
    
    select * from office;
	
create table person_estate
    (person_id int not null,  
    first_name varchar (25),
    last_name varchar (25),
    county varchar(30),
    street_address varchar (50),
    city varchar (20),
    state varchar (2),
    zip NUMERIC (5,0),
    email varchar (30),
    primary key (person_id)
    );
    
create table agent
    (license_num varchar(6),
    office_id int not null,
    firstname varchar(50),
    lastname varchar(50),
    commission_rate decimal(4,2),
    date_hired date,
    primary key(license_num),
    foreign key(office_id) references office on delete set null
    );
    
select * from agent;
delete from agent where license_num='zws111';
    
create table buyer
	(buyer_id int not null,
	person_id int not null,
	req_move_date date,
	min_preferred_price int,
	max_preferred_price int,
	primary key (buyer_id),
	foreign key (person_id) references person_estate on delete cascade
	);

create table seller
	(seller_id int not null,
	person_id int not null,
	vacancy_date date,
	primary key (seller_id),
	foreign key (person_id) references person_estate on delete cascade
	);
    
create table property
    (prop_id int not null,
	license_num varchar(6) not null,
    county varchar (30),
    street_address varchar(50),
    city varchar (20),
    p_state varchar (2),
    zip NUMERIC (5,0),
    p_type varchar (15),
    listing_price decimal (10,2),
    prop_date date,
    num_of_rooms int,
    num_of_bedrooms int,
    square_footage int,
    lot_size varchar (15),
    have_pool varchar (1),
    primary key (prop_id),
	foreign key (license_num) references agent on delete cascade
    );
       
create Table listing
    (prop_id int not null,
    purchase_date date,
    price numeric (8),
    primary key (prop_id),
    foreign key (prop_id) references property on delete cascade
    );
    
    commit;

/* Office inserts */
insert into office
values (10000, 'Sibcy Cline', '4885 Houston Rd', 'Florence', 'KY', 41042, 'sibcyclineestate@gmail.com');
insert into office
values (10001, 'Star One Realtors', '580 Buttermilk Pike', 'Crescent Springs', 'KY', 41017, 'starone@gmail.com');
insert into office
values (10002, 'Boardwalk Realtors', '3233 Westbourne Dr', 'Cincinnati', 'OH', 45248, 'boardwalkRealtors@gmail.com');
insert into office
values (10003, 'Christman Family Realtors', '2801 Amsterdam Rd', 'Villa Hills', 'KY', 41017, 'christman@gmail.com');
insert into office
values (10004, 'Lohmiller Real Estate', '1035 Vandercar Way', 'Florence', 'KY', 41012, 'lohmillerEstate@gmail.com');
insert into office
values (10005, 'Julz Brown Comey and Shepherd Realtors', '2342 Flora St', 'Cincinnati', 'OH', 45219, 'comeyShepherd@gmail.com');


/* People inserts */
insert into person_estate
values (05, 'Joe', 'Smith', 'Hamilton', '34 Orchard Ave', 'Winter Park', 'OH', 32792, 'jsmith@hotmail.com');
insert into person_estate
values (10, 'Bill', 'Murray', 'Boone','1801 Century Park', 'Hebron', 'KY', 41048, 'murray_b@gmail.com');
insert into person_estate
values (15, 'Ken', 'Griffey Jr', 'Campbell', '341 Edgewater Ave', 'Mason', 'OH', 45040, 'thekid@gmail.com');
insert into person_estate
values (20, 'George', 'Clooney', 'Ft Thomas', '231 Highlands Park', 'Highland Heights', 'KY', 41099, 'clooney1@hotmail.com');

/* Insert agents */
insert into agent
values ('jtf015', 10000, 'Josh', 'Flagg', 3, to_date('2001-06-26', 'yyyy-mm-dd'));
insert into agent
values ('jam991', 10003, 'Jade', 'Mills', 1.5, to_date('2006-01-04', 'yyyy-mm-dd'));
insert into agent
values ('jpa242', 10002, 'Josh', 'Altman', 1.75, to_date('2010-09-09', 'yyyy-mm-dd'));


/* Insert buyers */ 
insert into buyer
values (900, 05, TO_DATE('APR-21-2018','MON-DD-YYYY'), 25000, 30000);
insert into buyer
values (1000, 20, TO_DATE('OCT-1-2020','MON-DD-YYYY'), 75000, 100000);

/* Insert sellers */
insert into seller
values (555, 10, TO_DATE('MAY-01-2020', 'MON-DD-YYYY'));
insert into seller
values (333, 15, TO_DATE('DEC-01-2020', 'MON-DD-YYYY'));

/* Insert property */
insert into property
values (90, 'jtf015', 'Boone', 'Oak Dr', 'Burlington', 'KY', 41005, 'House', 75000.00, TO_DATE('NOV-05-2019', 'MON-DD-YYYY'), 7, 3, 2600, '.2 acres', 'Y');
insert into property
values (75, 'jam991', 'Campbell', 'Weevil Way', 'Wilder', 'KY', 41005, 'House', 45000.00, TO_DATE('JUN-09-2018', 'MON-DD-YYYY'), 6, 4, 2200, '.16 acres', 'N');
insert into property
values (30, 'jtf015', 'Campbell', 'Tree Way', 'Alexandria', 'KY', 41005, 'House', 57000.00, TO_DATE('JUN-22-2018', 'MON-DD-YYYY'), 6, 3, 2200, '1 acre', 'N');
insert into property
values (40, 'jpa242', 'Campbell', 'River Rd', 'Southgate', 'KY', 41005, 'House', 120000.00, TO_DATE('MAR-05-2020', 'MON-DD-YYYY'), 10, 4, 4000, '10 acres', 'Y');
insert into property
values (80, 'jpa242', 'Ripley', 'Little Ln', 'Cincinnati', 'OH', 45248, 'Apartment', 25000.00, TO_DATE('MAY-20-2019', 'MON-DD-YYYY'), 6, 2, 950, null, 'N');
insert into property
values (85, 'jam991', 'Hamilton', 'Center Ln', 'Cincinnati', 'OH', 45248, 'Apartment', 30000.00, TO_DATE('JAN-01-2020', 'MON-DD-YYYY'), 7, 3, 1000, null, 'Y');
insert into property
values (60, 'jam991', 'Boone', 'Cherry Dr', 'Union', 'KY', 41000, 'House', 90000.00, TO_DATE('NOV-22-2020', 'MON-DD-YYYY'), 9, 3, 3000, '1.5 acres', 'Y');

select * from property;
/* Query 1 */
select street_address, city, p_state, zip
from property
where county = 'Campbell'
and have_pool = 'N'
and num_of_bedrooms >= 4;

/* Query 2 */


