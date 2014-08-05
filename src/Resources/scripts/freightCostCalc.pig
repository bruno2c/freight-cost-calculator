register /usr/local/pig/build/ivy/lib/Pig/avro-mapred-1.7.5.jar
register /usr/local/pig/contrib/piggybank/java/piggybank.jar
register /usr/local/pig/build/ivy/lib/Pig/avro-1.7.5.jar
register /usr/local/pig/build/ivy/lib/Pig/json-simple-1.1.jar
register /usr/local/pig/build/ivy/lib/Pig/joda-time-2.1.jar

-- prepare the environment
define AvroStorage org.apache.pig.piggybank.storage.avro.AvroStorage();
rmf work/scriptResults.avro
rmf work/scriptResults

-- begin script
rawCarriers = LOAD 'work/carriers.avro' USING AvroStorage();
rawFreightCost = LOAD 'work/freightCost.avro' USING AvroStorage();

freightCost = JOIN rawFreightCost BY carrier_id, rawCarriers BY id;
freightCost = FILTER freightCost BY (start_cep <= '$targetPostcode') AND (final_cep >= '$targetPostcode');
freightCost = ORDER freightCost BY base_freight_cost ASC;
freightCost = LIMIT freightCost 3;

freightCostResult = FOREACH freightCost 
	GENERATE 
		rawFreightCost::id AS id, 
		rawFreightCost::carrier_id AS carrier_id, 
		rawFreightCost::base_freight_cost AS base_freight_cost, 
		rawFreightCost::delivery_time AS delivery_time;

STORE freightCostResult INTO 'work/scriptResults.avro' USING AvroStorage('{
	"namespace": "freightcost.result",
	"type": "record",
	"name": "FreightCost",
	"fields": [
		{ "name": "id", "type": "int" },
		{ "name": "carrier_id", "type": "int" }, 
		{ "name": "base_freight_cost", "type": ["float", "null"] }, 
		{ "name": "delivery_time", "type": "int" }		
	]
}');

STORE freightCostResult INTO 'work/scriptResults';