<?php

declare(strict_types=1);

namespace Projom\Tests\Unit\Util;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use Projom\Util\Sql;

class SqlTest extends TestCase 
{
	#[Test]
	public function quoteList(): void
	{
		$result = Sql::quoteList(['User', 'Role']);
		$expected = ['`User`', '`Role`'];
		$this->assertEquals($expected, $result);
	}

	#[Test]
	public function quote(): void
	{
		$result = Sql::quote('User');
		$expected = '`User`';
		$this->assertEquals($expected, $result);
		
		$result = Sql::quote('*');
		$expected = '*';
		$this->assertEquals($expected, $result);
	}

	#[Test]
	public function quoteAndJoin(): void
	{
		$result = Sql::quoteAndJoin(['User', 'Role']);
		$expected = '`User`,`Role`';
		$this->assertEquals($expected, $result);
	}

	#[Test]
	public function splitThenQuoteAndJoin(): void
	{
		$result = Sql::splitThenQuoteAndJoin(' User.RoleID ', '.');
		$expected = '`User`.`RoleID`';
		$this->assertEquals($expected, $result);
	}

	#[Test]
	public function splitAndQuote(): void
	{
		$result = Sql::splitAndQuote('User,Role');
		$expected = ['`User`', '`Role`'];
		$this->assertEquals($expected, $result);
	}

	#[Test]
	public function splitAndQuoteThenJoin(): void
	{
		$result = Sql::splitAndQuoteThenJoin('User,Role');
		$expected = '`User`,`Role`';
		$this->assertEquals($expected, $result);
	}
}
