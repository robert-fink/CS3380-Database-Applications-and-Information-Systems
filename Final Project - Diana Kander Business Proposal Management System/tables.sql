create table business (
    cid             int primary key auto_increment,
    name            varchar(64) not null,
    description     varchar(256),
    exit_strategy   varchar(256),
    regul_issues    varchar(256)
)ENGINE=INNODB;

create table opportunity (    
    cid             int,
    entry           int auto_increment,
    problem         varchar(256),
    problem_val     varchar(256),
    solution        varchar(256),
    solution_val    varchar(256),
    solution_status varchar(256),
    foreign key (cid) references business (cid) on delete cascade,
    primary key (cid,entry)
)ENGINE=INNODB;
    
create table funding (
    cid             int,
    entry           int auto_increment,
    funding_needed  int unsigned,
    funding_use     varchar(256),
    foreign key (cid) references business (cid) on delete cascade,
    primary key (cid,entry)
)ENGINE=INNODB;
    
create table users (
    username        varchar(64) primary key,
    hashed_password varchar(256),
    name            varchar(64),
    age             int,
    sex             char(1),
    zipcode         int,
    is_admin        boolean default false,
    foreign key (cid) references business (cid) on delete cascade
)ENGINE=INNODB;

create table user_business (
    cid             int,
    username        varchar(64),
    foreign key (cid) references business (cid) on delete cascade,
    foreign key (username) references users (username) on delete cascade,
    primary key (cid,username)
)ENGINE=INNODB;

create table sales_chan (
    cid             int,
    entry           int auto_increment,
    description     varchar(256),
    foreign key (cid) references business (cid) on delete cascade,
    primary key (cid,entry)
)ENGINE=INNODB;

create table team (
    name            varchar(64) primary key,
    title           varchar(64),
    description     varchar(256),
)ENGINE=INNODB;

create table team_business (
    cid             int,
    name            varchar(64),
    foreign key (cid) references business (cid) on delete cascade,
    foreign key (name) references team (name) on delete cascade,
    primary key (cid,name)
)ENGINE=INNODB;

create table competitive_analysis (
    cid             int,
    entry           int auto_increment,
    cur_behav       varchar(256),
    advantage       varchar(256),
    foreign key (cid) references business (cid) on delete cascade,
    primary key (cid,entry)
)ENGINE=INNODB;

create table marketing_efforts (
    cid             int,
    mark_when       varchar(16),
    mark_what       varchar(256),
    foreign key (cid) references business (cid) on delete cascade,
    primary key (cid,mark_when)
)ENGINE=INNODB;

create table fin_projections (
    cid             int,
    fin_year        varchar(16),
    income          int unsigned,
    expenses        int unsigned,
    net             int unsigned,
    foreign key (cid) references business (cid) on delete cascade,
    primary key (cid,fin_year)
)ENGINE=INNODB;

create table milestones (
    cid             int,
    mile_when       varchar(16),
    mile_what       varchar(256),
    foreign key (cid) references business (cid) on delete cascade,
    primary key (cid,mile_when)
)ENGINE=INNODB;

create table partners (
    name            varchar(64) primary key,
    title           varchar(64),
    description     varchar(256),
)ENGINE=INNODB;

create table partner_business (
    cid             int,
    name            varchar(64),
    foreign key (cid) references business (cid) on delete cascade,
    foreign key (name) references partners (name) on delete cascade,
    primary key (cid,name)
)ENGINE=INNODB;

create table compare_exits (
    cid             int,
    co_name         varchar(64),
    co_exit         varchar(256),
    acquirer        varchar(64)
    foreign key (cid) references business (cid) on delete cascade,
    primary key (cid,co_name)
)ENGINE=INNODB;

create table ant_rounds (
    cid             int,
    round_year      varchar(16),
    amount          int unsigned,
    foreign key (cid) references business (cid) on delete cascade,
    primary key (cid,round_year)
)ENGINE=INNODB;

create table intellectual_property (
    cid             int,
    entry           int auto_increment,
    description     varchar(256),
    foreign key (cid) references business (cid) on delete cascade,
    primary key (cid,entry)
)ENGINE=INNODB;

create table market (
    cid             int,
    entry           int auto_increment,
    description     varchar(256),
    foreign key (cid) references business (cid) on delete cascade,
    primary key (cid,entry)
)ENGINE=INNODB;