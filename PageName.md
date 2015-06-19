# Introduction #

Here's the basic idea for the full database tables.


# Details #

Classes: ClassCode, ClassName, StartTime, EndTime, CreditHrs, Faculty

> ClassCode - The code used to identify the class

> ClassName - The name of the class

> StartTime - yyyy-mm-dd hr:min

> EndTime   - yyyy-mm-dd hr:min

> CreditHrs - The credit hrs from the class

> Faculty - The faculty member instructing the class

StudentClasses: Onyen, ClassCode

> Onyen	  - Student's Onyen (from student)

> ClassCode - The code used to identify the class (from Classes table)

Admins: UserName

> UserName - Admin's username