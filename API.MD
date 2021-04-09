<h1>API GUIDE</h1>
<i><b>Note:</b> This guide assumes you already have loaded in the appropriate bearer token from: <pre>/apiauth/x509</pre></i>
All routes are prefixed with <pre>api/</pre>
<h2>Medical Service: MD</h2>
<pre>patients</pre>
GET. Shows all patients.
<pre>patients/{patient}</pre>
GET. Shows info for one patient.
<pre>research/{entry}</pre>
PATCH. Update one research entry. Parameters:
<pre>{"successful":0/1}</pre>
<h2>Logistics: LG</h2>
<pre>patientlocations</pre>
GET. Get all patient locations
<pre>patientlocations/{patient}</pre>
GET. Get all locations for a certain patient.
<pre>hospitals</pre>
GET. Get all hospitals
<pre>hospitals/{hospital}</pre>
GET. Show information for one hospital.
<pre>patientlocations/{patient}</pre>
POST. Add a patient to a location. Parameters:
<pre>{"hospital_id":id}</pre>
<pre>deliveries</pre>
GET. Get all deliveries
<pre>deliveries/{delivery}</pre>
GET. Get a single delivery.
<pre>deliveries</pre>
POST. Add a new delivery. Parameters:
<pre>{"destination":id, "contents":contents, "quantity":1/600}</pre>
<pre>deliveries/{delivery}</pre>
DELETE. Delete a delivery.
<h2>R&D: RD</h2>
<pre>research</pre>
GET. Get all research
<pre>research/{entry}</pre>
GET. Get a single trial
<pre>research/placebo</pre>
GET. Get all placebo trials
<pre>research/live</pre>
GET. Get all live trials
<pre>research</pre>
POST. Add a new trial. Parameters:
<pre>{"patient_id":id, "placebo":0/1}</pre>
<h2>IT department: IT</h2>
Access to all of the above!
