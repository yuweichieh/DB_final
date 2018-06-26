# DB_final
> Deadline 6/29 23:59
---
## Left to be done
* bonus(Edit)
* Captcha
* bug in signup view (can't see the signers' name)

## Schema
* user { <br />
    id (int, auto inc, primary key), <br />
    student_id (varchar(7)), <br />
    email (varchar(255)), <br />
    password (varchar(255)), <br />
    name (varchar(255)) <br />
  } <br />
* announces { <br />
    ann_id (int, auto inc, primary key), <br />
    title (varchar(255)), <br />
    content (text), <br />
    ann_date (current timestamp) <br />
  } <br />
* event { <br />
    event_id (int, auto inc, primary key), <br />
    name (varchar(255)), <br />
    date (date), <br />
    mem_limit (int), <br />
    team_limit (int), <br />
    rule (text) <br />
  } <br />
* signs { <br />
    sign_id (int, auto inc, primary key), <br />
    team_id (varchar(255)), <br />
    student_id (varchar(7)), <br />
    event_id (int) <br />
  } <br />
* teams { <br />
    team_id (int, auto inc, primary key), <br />
    team_name (varchar(255)), <br />
    for_event (int) <br />
  } <br />